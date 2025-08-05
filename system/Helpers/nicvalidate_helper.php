<?php
    function nic_parse($id_number){
        $validate_value = false;
        if(checkLength($id_number)){
            $validate_value = true;

            $numbersInNIC = '';
            if(strlen(strtoupper($id_number)) === 10){
                $numbersInNIC .= substr($id_number, 0, 9);
            }else{
                $numbersInNIC .= $id_number;
            }

            if(checkBirthDate($numbersInNIC)){
                $validate_value = true;
                if(detectFormat($id_number)){
                    $validate_value = true;
                }
                else{
                    $validate_value = false;
                }
            }
            else{
                $validate_value = false;
            }
        }
        else{
            $validate_value = false;
        }
        return $validate_value;
    }

    function checkLength($id_number) {
        $id_number = strtoupper($id_number);
        $strlen = strlen($id_number);

        if ($strlen === 10) {
            if ($id_number[9] !== 'V' && $id_number[9] !== 'X') {
                return false;
            }
            $id_number = substr($id_number, 0, 9);
        } elseif($strlen === 12){
            $id_number = substr($id_number, 0, 12);
        } else{
            return false;
        }

        if (!ctype_digit($id_number)) {
            return false;
        }

        return true;
    }

    function checkBirthDate($id_number) {
        $full_number = strlen($id_number) === 9
            ? '19'.$id_number
            : $id_number;

        $year = (int)substr($full_number, 0, 4);
        $data_components['year'] = $year;

        checkBirthYear($year);
        $value = buildBirthDateObject($full_number, $year);
        $data_components['serial'] = (string)substr($full_number, 7);
        return $value;
    }

    function checkBirthYear($year) {
        if ($year < 1900 || $year > 2100) {
            return false;
        }
        else{
            return true;
        }
    }

    function buildBirthDateObject($full_number,$year){
        $birthday = new DateTime();

        $birth_days_since = (int)substr($full_number, 4, 3);

        if ($birth_days_since > 500) {
            $birth_days_since -= 500;
            $data_components['gender'] = 'F';
        } else {
            $data_components['gender'] = 'M';
        }

        // Array representing the number of days in each month for non-leap and leap years
        $months = [31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

        $month = 0;
        $remainingDays = $birth_days_since;  
        
        // Loop through the months to find which month the day falls in
        foreach ($months as $index => $daysInMonth) {
            if ($remainingDays <= $daysInMonth) {
                $month = $index + 1;
                $dayOfMonth = $remainingDays;  // The remaining days is the exact day in the month
                break;
            }
            $remainingDays -= $daysInMonth;  // Subtract the days in the current month
        }

        $birthday->setDate($year, $month, $dayOfMonth);

        $data_components['date'] = $birthday;

        if ($birthday->format('Y') == $year) {
            return true;
        }
        else{
            return false;
        }
    }

    function detectFormat($id_number) {
        $strlen = strlen($id_number);

        if ($strlen === 12) {
           $data_components['format'] = 2;
           return true;
        } 
        else if($strlen === 10) {
           $data_components['format'] = 1;
           return true;
        }
        else{
            return false;
        }
    }

    function getBirthday(): DateTime {
        return $data_components['date'];
    }

    function getSerialNumber(): string {
        return (string)$data_components['serial'];
    }

    function getFormat(): int {
        return $data_components['format'];
    }

    function getGender(): string {
        return $data_components['gender'];
    }