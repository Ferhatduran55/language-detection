<?php
class Language
{
    public static $language;
    private static $languageFile = "language.json";
    private static $languageFileIsObject = true;
    public static $langs = [];
    private static $setup = false;
    private static $languageFormat = 0;
    private static function eval($compile=null)
    {
        if(isset($compile)){
            if(strpos($compile,"self") !== true){
                eval($compile);
            }
        }
    }
    public static function Condition($if = array("condition" => null, "function" => null), $elseif = array("condition" => null, "function" => null), $else = array("function" => null))
    {
        if ((isset($if) && !isset($elseif) && !isset($else)) && (isset($if["condition"]))) {
            if ($if["condition"]) {
                self::eval($if["function"]);
            }
        } else if ((isset($if) && !isset($elseif) && isset($else)) && (isset($if["condition"]))) {
            if ($if["condition"]) {
                self::eval($if["function"]);
            } else {
                self::eval($else["function"]);
            }
        } else if ((isset($if) && isset($elseif) && isset($else)) && (isset($if["condition"]) && isset($elseif["condition"]))) {
            if ($if["condution"]) {
                self::eval($if["function"]);
            } else if ($elseif["condition"]) {
                self::eval($elseif["function"]);
            } else {
                self::eval($else["function"]);
            }
        } else {
            return false;
        }
    }
    private static function Exception($except)
    {
        if(isset($except)){
            die($except);
        }
    }
    public static function Start($optionLang = null)
    {
        if (!self::$setup) {
            if (isset($optionLang)) {
                self::SetLanguage($optionLang);
                self::GetLang();
                self::ToggleSetup();
            } else {
                self::ControlLanguage();
                self::GetLang();
                self::ToggleSetup();
            }
            if (!self::$languageFormat > 0) {
                self::GetLang();
            }
        }
    }
    private static function ToggleSetup()
    {
        if (self::$setup) {
            self::$setup = False;
        } else {
            self::$setup = True;
        }
    }
    private static function ControlLanguage()
    {
        if (!isset(self::$language)) {
            self::SetLanguage();
        }
    }
    private static function SetLanguage($val = null)
    {
        if (!isset($val)) {
            self::$language = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
        } else {
            if (isset(self::JsonDecode(self::GetFile(self::$languageFile), self::$languageFileIsObject)["language"][$val])) {
                self::$language = trim($val);
            }
        }
    }
    public static function GetLanguage()
    {
        return self::$language;
    }
    private static function GetFile($filename)
    {
        try {
            if (isset($filename)) {
                return file_get_contents(trim($filename));
            }
        } catch (Exception $e) {
            self::Exception($e);
        }
    }
    private static function JsonEncode($data)
    {
        try {
            if (isset($data)) {
                return json_encode($data);
            }
        } catch (Exception $e) {
            self::Exception($e);
        }
    }
    private static function JsonDecode($data, $object = false)
    {
        try {
            if (isset($data)) {
                return json_decode($data, $object);
            }
        } catch (Exception $e) {
            self::Exception($e);
        }
    }
    public static function GetLang()
    {
        self::$languageFormat = 1;
        self::$langs = self::JsonDecode(self::GetFile(self::$languageFile), self::$languageFileIsObject)["language"][self::GetLanguage()];
    }
    public static function GetLangs()
    {
        self::$languageFormat = 2;
        self::$langs = self::JsonDecode(self::GetFile(self::$languageFile), self::$languageFileIsObject)["language"];
    }
    public static function GetValue($val = null, $val2 = null)
    {
        try {
            if (isset($val) && $val !== "") {
                if (self::$languageFormat === 1) {
                    if (is_array(self::$langs[$val]) && isset($val2) && isset(self::$langs[$val][$val2])) {
                        return self::$langs[$val][$val2];
                    } else if (!is_array(self::$langs[$val]) && isset(self::$langs[$val])) {
                        return self::$langs[$val];
                    } else {
                        return false;
                    }
                } else if (self::$languageFormat === 2) {
                    if (is_array(self::$langs[self::GetLanguage()][$val]) && isset($val2) && isset(self::$langs[self::GetLanguage()][$val][$val2])) {
                        return self::$langs[self::GetLanguage()][$val][$val2];
                    } else if (!is_array(self::$langs[self::GetLanguage()][$val]) && isset(self::$langs[self::GetLanguage()][$val])) {
                        return self::$langs[self::GetLanguage()][$val];
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } catch (Exception $e) {
            self::Exception($e);
        }
    }
}
Language::Start();
?>
