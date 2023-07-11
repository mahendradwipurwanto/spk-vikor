<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vikor {

    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
    }

    public function calculate_vikor($alternatives, $criteria_weights, $veto)
    {
        // 1. Matrix
        $matrix = $this->generate_matrix($alternatives);

        // 2. Menghitung Benefit dan Cost
        $benefit_cost = $this->calculate_benefit_cost($matrix);

        // 3. Normalisasi Bobot (n*b)
        $normalized_weights = $this->normalize_weights($criteria_weights, $benefit_cost);

        // 4. Menentukan Si dan Ri
        $si_ri = $this->calculate_si_ri($normalized_weights);

        // 5. Hasil perhitungan vikor sesuai nilai veto(v)
        $vikor_result = $this->calculate_vikor_veto_v($si_ri, $veto);

        // 6. Sorting peringkat dari berdasarkan hasil 5
        $ranked_results = $this->rank_results($vikor_result, $veto);

        // 7. Menentukan Acceptable Advantage dengan margin 0.25, 0.5, 0.75
        $acceptable_advantage = $this->calculate_acceptable_advantage($alternatives, $ranked_results, $veto);

        // Return hasil perhitungan VIKOR
        return array(
            'matrix' => $matrix,
            'benefit_cost' => $benefit_cost,
            'normalized_weights' => $normalized_weights,
            'si_ri' => $si_ri,
            'vikor_result' => $vikor_result,
            'ranked_results' => $acceptable_advantage['ranked_results'],
            'acceptable_advantage' => $acceptable_advantage['acceptable_advantage']
        );
    }

    protected function generate_matrix($alternatives)
    {
        $matrix = array();
        foreach ($alternatives as $key => $val) {
            $id = $val["id"];
            unset($val["id"]);
            $matrix[$id] = array_values($val);
        }
        return $matrix;
    }

    protected function calculate_benefit_cost($matrix)
    {

        $benefit_cost = [];

        foreach ($matrix as $row => $column) {

            foreach ($column as $key => $val) {
                if ($key === 0) {
                    continue; // Skip the first column (alternative name)
                }
                
                $max = min_max_value($matrix, $key)['max'];
                $min = min_max_value($matrix, $key)['min'];

                if(in_array($key, [1, 6, 7])){
                    $round = 3;
                }else if(in_array($key, [3, 4])){
                    $round = 2;
                }else{
                    $round = 9;
                }

                // ej($);
                // cost
                if($key === 1){
                    $rumus['calc'] = safeDivision(($val-$min),($max-$min));
                    $rumus['rumus'] = "(({$val}-{$min})/({$max}-{$min}))";
                
                // benefit
                }else{
                    $rumus['calc'] = safeDivision(($max-$val),($max-$min));
                    $rumus['rumus'] = "(({$max}-{$val})/({$max}-{$min}))";
                }

                // calc
                $arr[$key]['calc'] = round_custom($rumus['calc'], $round, true);
                $arr[$key]['rumus'] = $rumus['rumus'];
            }

            $benefit_cost[$row] = array_values($arr);
        }
        return $benefit_cost;
    }

    protected function normalize_weights($criteria_weights, $benefit_cost)
    {

        $normalize_weights = [];
        foreach($benefit_cost as $row => $column){
            foreach($column as $key => $val){

                if($key === 0){
                    $round = 2;
                }else{
                    $round = 4;
                }

                $rumus['calc'] = round_custom($val['calc']*$criteria_weights[$key]['weight'], $round, true);
                $rumus['rumus'] = "{$val['calc']}*{$criteria_weights[$key]['weight']}";

                $arr[$key]['rumus'] = $rumus['rumus'];
                $arr[$key]['calc'] = $rumus['calc'];
            }
            $normalize_weights[$row] = array_values($arr);
        }
        return $normalize_weights;
    }

    protected function calculate_si_ri($normalized_weights)
    {
        $si_ri = [];

        foreach ($normalized_weights as $row => $column) {
            foreach ($column as $key) {

                $max = min_max_value($column, 'calc')['max'];

                $si = round_custom(array_sum(array_column($column, 'calc')), 2);
                $ri = round_custom($max, 2);
            }

            $si_ri[$row] = [
                'si' => $si,
                'ri' => $ri
            ];
                  
        }

        $si_max = min_max_value($si_ri, 'si')['max'];
        $si_min = min_max_value($si_ri, 'si')['min'];
        $ri_max = min_max_value($si_ri, 'ri')['max'];
        $ri_min = min_max_value($si_ri, 'ri')['min'];

        return [
            'si_ri' => $si_ri,
            'si_max' => $si_max,
            'si_min' => $si_min,
            'ri_max' => $ri_max,
            'ri_min' => $ri_min,
        ];
    }

    protected function calculate_vikor_veto_v($si_ri, $veto)
    {
        $vikor_result = [];
        
        foreach ($si_ri['si_ri'] as $row => $column) {
            foreach ($veto as $key => $val) {

                $arr[$key]['calc'] = round_custom($val*(safeDivision(($column['si']-$si_ri['si_min']),($si_ri['si_max']-$si_ri['si_min'])))+(1-$val)*(safeDivision(($column['ri']-$si_ri['ri_min']),($si_ri['ri_max']-$si_ri['ri_min']))), 2, true);
                $arr[$key]['raw'] = round_custom($val*(safeDivision(($column['si']-$si_ri['si_min']),($si_ri['si_max']-$si_ri['si_min'])))+(1-$val)*(safeDivision(($column['ri']-$si_ri['ri_min']),($si_ri['ri_max']-$si_ri['ri_min']))), 2);
                $arr[$key]['rumus'] = "({$val}*(({$column['si']}-{$si_ri['si_min']})/({$si_ri['si_max']}-{$si_ri['si_min']}))+(1-{$val})*(({$column['ri']}-{$si_ri['ri_min']})/({$si_ri['ri_max']}-{$si_ri['ri_min']})))";
            }

            foreach ($veto as $key => $val) {
                $vikor_result[$key][$row] = $arr[$key];
            }
        }

        return $vikor_result;
    }

    protected function rank_results($vikor_result, $veto)
    {
        
        $ranked_results = [];
        if(!empty($vikor_result)){
            foreach ($veto as $row => $column) {
                foreach ($vikor_result[$row] as $key => $val) {
                    $ranked_results[$row][$key]['calc'] = $val['calc'];
                    $ranked_results[$row][$key]['raw'] = $val['raw'];
                    $ranked_results[$row][$key]['id'] = $key;
                }
    
                usort($ranked_results[$row], function($a, $b) {
                    return $a['calc'] <=> $b['calc'];
                });
            }
        }

        return $ranked_results;
    }

    protected function calculate_acceptable_advantage($alternatives, $ranked_results, $veto)
    {
        $acceptable_advantage = [];

        if(!empty($ranked_results)) {
            $acceptable_advantage['dq'] = safeDivision(1,(count($alternatives)-1));
            
            foreach ($ranked_results as $key => $val){
                $acceptable_advantage['v'][$key]['key'] = "v={$veto[$key]}, 𝑄(𝐴2) - 𝑄(𝐴1)";
                if(count($val) > 1){
                    $acceptable_advantage['v'][$key]['value'] = $val[1]['raw']-$val[0]['raw'];
                }else{
                    $acceptable_advantage['v'][$key]['value'] = $val[0]['raw']-$val[0]['raw'];
                }
                $acceptable_advantage['v'][$key]['veto'] = $key;
                $acceptable_advantage['v'][$key]['acceptable'] = false;
            }       
            $targetValue = $acceptable_advantage['dq'];
            $closestValue = array_reduce(
                array_values($acceptable_advantage['v']),
                function ($carry, $item) use ($targetValue) {
                    $currentDifference = abs($item['value'] - $targetValue);
                    $closestDifference = isset($carry) ? abs($carry['value'] - $targetValue) : PHP_FLOAT_MAX;
    
                    return $currentDifference < $closestDifference ? $item : $carry;
                }
            );
    
            $acceptable_advantage['v'][$closestValue['veto']]['acceptable'] = true;
            return [
                'acceptable_advantage' => $acceptable_advantage,
                'ranked_results' => [
                    'veto' => $veto[$closestValue['veto']],
                    'ranked'=> $ranked_results[$closestValue['veto']]
                ]
            ];
        }else{
            return [
                'acceptable_advantage' => [
                    'dq' => null,
                    'v' => []
                ],
                'ranked_results' => [
                    'veto' => null,
                    'ranked'=> []
                ]
            ];
        }

    }
}
