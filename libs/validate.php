<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 18-Dec-17
 * Time: 3:08 PM
 */

class validate
{
    private $sourse = array();
    private $errors = array();
    private $rules = array();
    private $result = array();

    public function __construct($sourse)
    {
        $this->sourse = $sourse;
    }

    public function geterror()
    {
        return $this->errors;
    }

    public function getresult()
    {
        return $this->result;
    }

    // hàm quy định
    public function addrules($rules)
    {
        $this->rules = array_merge($this->rules, $rules);

    }

    public function addrule($element, $type, $option = null, $require = true)
    {
        $this->rules[$element] = array('type' => $type, $option, 'require' => $require);
        return $this;
    }

    public function seterror($element, $message)
    {
        if (array_key_exists($element, $this->errors)) {
            $this->errors[$element] .= ' -' . $message;
        } else {
            $this->errors[$element] = $message;
        }

    }

    // kiểm tra
    public function checkvalidate()
    {
        foreach ($this->rules as $element => $value) {
            if ($value['require'] == true && trim($this->sourse[$element]) == null && empty($this->sourse[$element])) {
//           $this -> errors[$element] = "<b>$element</b>". ' ' .' not empty !';
                $this->seterror(ucfirst($element), "</b>$element</b>" . ' ' . ' not empty !');
            } else {
                switch ($value['type']) {
                    case 'string':
                        $this->ckeckstring($element, $value[0]['min'], $value[0]['max']);
                        break;
                    case 'int':
                        $this->ckeckage($element, $value[0]['min'], $value[0]['max']);
                        break;
                    case 'url':
                        $this->ckechurl($element);
                        break;
                    case 'email':
                        $this->ckechmail($element);
                        break;
                    case 'status':
                        $this->ckechstatus($element, $value[0]['deny']);
                        break;
                    case 'password':
                        $this->chechpasswordtype($element, $value[0]);
                        break;
                    case 'group':
                        $this->ckechgroup($element);
                        break;
                    case 'birthday':
                        $this->ckechbirthday($element, $value[0]['start'], $value[0]['end']);
                        break;
                    case 'recordexist':
                        $this->ckeckrecord($element, $value[0]);
                        break;
                    case 'exist-string':
                        $this->ckeckrecord($element, $value[0]);
                        $this->ckeckstring($element, $value[0]['min'], $value[0]['max']);
                        break;
                    case 'file':
                        $this->ckeckFiles($element, $value[0], $value[0]['min'], $value[0]['max']);
                        break;
                    case 'ordering':
                        $this->checkOrdering($element, $value[0]['max'][0]);
                        break;
                    case 'email-exist':
                        $this->ckechmail($element);
                        $this->ckeckrecord($element, $value[0]);
                        break;
                    case 'user-exist':
                        $this->ckeckValiUser($element, $value[0]);
                        break;
                    case 'number':
                        $this->ckeckNumber($element);
                        break;
                }
            }
            if (!array_key_exists($element, $this->errors)) {
                $this->result[$element] = $this->sourse[$element];
            }
        }
        $elenotvalidate = array_diff_key($this->sourse, $this->errors);
        $this->result   = array_merge($this->result, $elenotvalidate);
    }
    private function ckeckNumber($element)
    {
        if(!is_numeric($this->sourse[$element])){
            $this->seterror($element, 'không phải number ');
        }

    }

       private function checkOrdering($element, $value)
    {
        if (!is_numeric($this->sourse[$element])) {
            $this->seterror($element, 'Type not numberic');
        } elseif ($this->sourse[$element] > $value) {
            $this->seterror($element, 'number quá lớn ');
        }
    }

    // string
    private function ckeckstring($element,$min,$max)
    {

        if (strlen($this->sourse[$element]) < $min) {
            $this->seterror($element, 'error length to string short !');
        } elseif (strlen($this->sourse[$element]) > $max) {
            $this->seterror($element, 'error length to string tall !');
        }
        if(!is_string($this -> sourse[$element]))
          {
             $this -> errors[$element] = 'type of not string !';
          }
//        $pattern = "#[A-z0-9]{" . $min . "," . $max . "}#";
//        if (!preg_match($pattern, $this->sourse[$element])) {
//            $this->seterror($element, 'type of not string !');
//        }
    }

    private function chechpasswordtype($element, $option)
    {

        if ($option['action'] == 'add' || ($option['action'] == 'edit' && $this->sourse[$element] != null)) {
            $pattern = '#^(?=.*\d)(?=.*[a-z])(?=.*\w).{8,8}$#';
            if (!preg_match($pattern, $this->sourse[$element])) {
                $this->seterror($element, 'password khong hop le !');
            }
        }

    }

    private function ckeckage($element, $min = 0, $max = 0)
    {
        if (!filter_var($this->sourse[$element], FILTER_VALIDATE_INT, array("options" => array("min_range" => $min, "max_range" => $max)))) {
            $this->seterror($element, 'this is age invalid !');
        }
    }

    private function ckechurl($element)
    {
        if (!filter_var($this->sourse[$element], FILTER_VALIDATE_URL)) {
            $this->seterror($element, 'this is url invalid  !');
        }
    }

    private function ckechmail($element)
    {

        if (!filter_var($this->sourse[$element], FILTER_VALIDATE_EMAIL)) {
            $this->seterror($element, 'this is email invalid !');
        }
    }

    public function showerrors()
    {
        $xhtml = '';
        if (!empty($this->errors)) {
            $xhtml .= '<ul class="error bg-warning">';
            foreach ($this->errors as $key => $value) {
                $xhtml .= '<li style="list-style: none" class="text-danger h3"><b>' . $key . '</b>.' . $value . '</li>';
            }
            $xhtml .= '</ul>';
        }
        return $xhtml;
    }

    public function showerrorElement()
    {
        $xhtml = '';
        if (!empty($this->errors)) {
            foreach ($this->errors as $key => $value) {
                $xhtml .= '<p class="text-danger h3">' . $value . '</p>';
            }
        }
        return $xhtml;
    }


    public function isvali()
    {
        if (count($this->errors) > 0) return false;
        return true;
    }

    public function ckechstatus($element, $option)
    {

        if (in_array($this->sourse[$element], $option)) {
            $this->seterror($element, 'status error!');
        }
    }

    public function ckechgroup($element)
    {
        if ($this->sourse[$element] <= 0) {
            $this->seterror($element, 'group error  !');
        }
    }


    private function ckechbirthday($element, $start, $end)
    {
        $arrdatestart = date_parse_from_format("d/m/y", $start);
        $timestart = mktime(0, 0, 0, $arrdatestart['month'], $arrdatestart['day'], $arrdatestart['year']);

        //end
        $arrdateend = date_parse_from_format("d/m/y", $end);
        $timeend    = mktime(0, 0, 0, $arrdateend['month'], $arrdateend['day'], $arrdateend['year']);

        $arrcurrent = date_parse_from_format("d/m/y", $this->sourse[$element]);
        $timecurrent = mktime(0, 0, 0, $arrcurrent['month'], $arrcurrent['day'], $arrcurrent['year']);
        if ($timecurrent < $timestart || $timecurrent > $timeend) {
            $this->seterror($element, 'birth not invali !');
        }
    }

    private function ckeckrecord($element, $options)
    {

        $database = $options['database'];
        $query    = $options['query'];


        //query
        if ($database->isExist($query)) {
            $this->seterror($element, 'Đã tồn tại bản ghi ');
        }
    }

    function ckeckFiles($element, $options)
    {
         $min = $options['min'];
         $max = $options['max'];
         $this->sourse[$element]['size'];

        if($this->sourse[$element]['name'] != ''){
            if (!filter_var($this->sourse[$element]['size'], FILTER_VALIDATE_INT, array("options" => array("min_range" => $min, "max_range" => $max)))) {
                $this->seterror($element, 'this is age invalid !');
            }
             $extension = pathinfo($this->sourse[$element]['name'], PATHINFO_EXTENSION);


            if(in_array($extension, $options['extension']) == false){
                $this->seterror($element, 'Extension not invalid !');
            }
        }

    }

    private function ckeckValiUser($element, $options)
    {

        $database = $options['database'];
        $query    = $options['query'];
        //query
        if ($database->isExist($query) == false) {
            $this->seterror($element, ucfirst($element).' hoặc Password không chính xác ');
        }
    }
}