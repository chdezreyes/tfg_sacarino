<?php

    class ControllerSumasySaldos{

        static public function ctrCreateSYS($ejercicio, $loginUser){

            $diario = ControllerPlanContable::ctrGetEjercicioData($ejercicio);

            //Rescatamos el plan del ejericio, si no existe lo creamos
            $plan = ControllerPlanContable::ctrGetPlan($ejercicio);
            if(!$plan){
                $plan = ControllerPlanContable::ctrCreatePlan($ejercicio);
            }else{
                $plan = $plan['id'];
            }

            $datosSYS = [];

            foreach ($diario as $entry) {
                $cuenta = $entry['cierre_cuenta'];
                $mes = $entry['cierre_mes_apunte'];
                $debe = (float) $entry['cierre_debe'];
                $haber = (float) $entry['cierre_haber'];
                $descripcion = $entry['cierre_descripcion'];
            
                if (!isset($datosSYS[$cuenta])) {
                    $datosSYS[$cuenta] = [
                        'cuenta' => $cuenta,
                        'descripcion' => $descripcion,
                        'meses' => []
                    ];
                }
            
                if (!isset($datosSYS[$cuenta]['meses'][$mes])) {
                    $datosSYS[$cuenta]['meses'][$mes] = 0;
                }
            
                $datosSYS[$cuenta]['meses'][$mes] += $debe - $haber;
            }

            ksort($datosSYS);

            $storeData = ModelSumasySaldos::mdlStoreSYS($plan, $datosSYS);

            if ($storeData == 'ok'){
                $empresa = ControllerEjercicios::ctrGetEjercicioFromEjercicio($ejercicio);
                $empresa = $empresa['ejercicio_empresa'];
                ControllerPlanContable::ctrUpdatePlan($plan, $loginUser);
                ControllerEmpresas::ctrUpdateEmpresa($empresa, $loginUser);
                return "ok";
            } else {
                return 'error';
            }
        }

        static public function ctrGetSYS($ejercicio){
            $plan = ControllerPlanContable::ctrGetPlan($ejercicio);
            $answer = ModelSumasySaldos::mdlGetSYS($plan['id']);
            return $answer;
        }

        static public function ctrGetSaldosFromGrupo($ejercicio, $grupo, $nivel){          
            
            $table = "cierre_plan";
            $plan = ModelPlanContable::mdlGetPlan($table, $ejercicio);
            $plan = $plan['id'];
        
            $table = "cierre_plan_detalle";
        
            //Inicializacion del array de acumulacion
            $accumulated = [];
        
            // Revisamos si $grupo es un array
            if (is_array($grupo)) {
                foreach ($grupo as $individualGrupo) {

                    $answers = ModelSumasySaldos::mdlGetSaldosFromGrupo($table, $plan, $individualGrupo);

                    foreach ($answers as $item) {
                        $key = $item['plan_detalle_cuenta'] . ' | ' . $item['plan_detalle_descripcion'];
        
                        if (!isset($accumulated[$key])) {
                            $accumulated[$key] = [
                                'plan_detalle_cuenta' => $item['plan_detalle_cuenta'],
                                'plan_detalle_descripcion' => $item['plan_detalle_descripcion'],
                                'total_plan_detalle_saldo' => 0
                            ];
                        }
        
                        $accumulated[$key]['total_plan_detalle_saldo'] += $item['plan_detalle_saldo'];
                    }
                }
            } else {
                $answers = ModelSumasySaldos::mdlGetSaldosFromGrupo($table, $plan, $grupo);
                foreach ($answers as $item) {
                    $key = $item['plan_detalle_cuenta'] . ' | ' . $item['plan_detalle_descripcion'];
        
                    if (!isset($accumulated[$key])) {
                        $accumulated[$key] = [
                            'plan_detalle_cuenta' => $item['plan_detalle_cuenta'],
                            'plan_detalle_descripcion' => $item['plan_detalle_descripcion'],
                            'total_plan_detalle_saldo' => 0
                        ];
                    }
        
                    $accumulated[$key]['total_plan_detalle_saldo'] += $item['plan_detalle_saldo'];
                }
            }
        
            $result = [];

            foreach ($accumulated as $key => $value) {
                $prefix = substr((string) $value["plan_detalle_cuenta"], 0, $nivel); //Ajustando el nivel de acumulacion
            
                if (isset($result[$prefix])) {
                    $result[$prefix]['total_plan_detalle_saldo'] += $value["total_plan_detalle_saldo"];
                } else {
                    $result[$prefix] = [
                        'plan_detalle_cuenta' => $prefix,
                        'plan_detalle_descripcion' => ControllerPlanContable::ctrGetNameFromCuenta($ejercicio, $prefix),
                        'total_plan_detalle_saldo' => $value["total_plan_detalle_saldo"]
                    ];
                }
            }

            return $result;
        }
        
    }

?>