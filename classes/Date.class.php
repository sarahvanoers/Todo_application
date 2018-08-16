<?php
    class Date{

        public function getTimestring($date){
            $datetime1 = new DateTime($date);
            $datetime2 = new DateTime(date("Y/m/d"));
            $interval = $datetime2->diff($datetime1);
            $days = $interval->format('%r%a');
            if($days > 1){
                $timestring = $days.' days left';
            }else if($days == 1){
                $timestring = $days.' day left';
            }else if($days < 1){
                    if($days<0){
                        $timestring = 'times up';
                    }else{
                    if($interval->hours >1){
                        $timestring = $interval->hours.' hours left';
                    }else if($interval->hours ==1 ){
                        $timestring = $interval->hours.' hour left';
                    }else if($interval->hours <1){
                        if($interval->minutes>0){
                            $timestring = $interval->minutes.' minutes left';
                        }else{
                            $timestring = 'times up';
                        }
                        
                    }
                }
            }
            return $timestring;
        }
    }
    // http://php.net/manual/en/dateinterval.format.php
    // http://php.net/manual/en/datetime.diff.php 
    // https://stackoverflow.com/questions/15421132/why-does-datetime-days-always-returns-a-positive-number                          
?>