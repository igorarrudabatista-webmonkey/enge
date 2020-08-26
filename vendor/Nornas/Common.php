<?php

namespace Nornas;

/**
 *
 * Classe responsável pelo armazenamento de funções bastante utilizadas
 * durante a escrita do código, para evitar código repetitivo, priorizando o
 * re-uso de código e facilitando a manutenção destas funções.
 *
 * Certas vezes, elaboramos uma função que tem uma determinada finalidade para
 * um projeto em andamento. Futuramente nos vemos na necessidade de utilizar
 * esta função novamente, mas se não à temos armazenada em algum local, somos
 * obrigados à refazê-la, gerando re-trabalho e perda de tempo.
 *
 * Como solução, permitimos o uso desta classe para tal finalidade. Criando
 * funções, que aqui serão armazenadas e mantidas como métodos, e somente
 * chamá-las quando necessário.
 *
 * Um exemplo de criação de um método para ser usado posteriormente, não neces-
 * sita de muitos passos, sendo necessário somente a criação de um método com
 * o acesso público e estático, da seguinte forma:
 *
 *      public static function nome_da_funcao($parametros)
 *      {
 *          // ... Bloco de código da função
 *      }
 *
 * Em caso de persistência de dúvidas, visite um exemplo funcional desta classe
 * no endereço abaixo.
 *
 * @example http://www.thomerson.com.br/nornas/examples/common.php Demonstração
 * da criação de funções de re-uso para o projeto.
 *
 * @since 1.0.0 Primeira vez que esta classe foi adicionada.
 *
 * @author Thomerson Roncally Araújo Teixeira <thomersonroncally@outlook.com>
 * @copyright 2014-2015 Thomerson Roncally Araújo Teixeira
 */

class Common
{
    /**
     * 
     * @method void __construct() Método construtor da classe, setado como privado para evitar instanciação da classe, o que indica que todos os métodos serão chamados estáticamente.
     * @access private
     */

    private function __construct(){}
    
    /**
     *
     * @method bool isEmpty(mixed $data) Verifica se uma variável é vazia.
     */

    public static function isEmpty($data=[])
    {
        if (!is_array($data)) {
            switch ($data) {
                case '0':
                    return false;
            }
        }
        
        if (count($data) == 0) {
            return true;
        }

        return false;
    }

    /**
     *
     * @method void redir(string $url) Redireciona o cliente para uma determinada URL.
     */
    
    public static function redir($url)
    {
        header("location: " . SITE_URL . $url);
        
        exit;
    }

    /**
     *
     * @method string sanitize(string $str) Sanitariza uma "string" substituindo alguns caracteres e excluindo outros.
     */

    public static function sanitize($str)
    {
        $str = strtolower($str);
        $str = preg_replace("/[ÁÀÂÃÄ|áàâãä]/ui", "a", $str);
        $str = preg_replace("/[ÉÈÊË|éèêë]/ui", "e", $str);
        $str = preg_replace("/[ÍÌÎÏ|íìîï]/ui", "i", $str);
        $str = preg_replace("/[ÓÒÔÕÖ|óòôõö]/ui", "o", $str);
        $str = preg_replace("/[ÚÙÛÜ|úùûü]/ui", "u", $str);
        $str = preg_replace("/[Ç|ç]/ui", "c", $str);
        $str = preg_replace("/[!?@#$%&*()\[\] \/\;:\.,{}]/ui", "-", $str);
        $str = preg_replace("/-+/ui", "-", $str);
        $str = preg_replace("/^[-]/ui", "", $str);
        $str = preg_replace("/[-]$/ui", "", $str);

        return $str;
    }

    /**
     *
     * @method bool|string format(string $type, string $var) Formata "strings", substituindo hífens por espaços em branco.
     */

    public static function format($type, $var = null)
    {
        if (self::isEmpty($var)) {
            return false;
        }

        switch ($type) {
            case 'str': {
                $var = str_replace("-", " ", $var);
                $var = ucfirst($var);
                return $var;
            }
            case 'localeToDate': {
                $date = explode("/", $var);
                $newDate = $date[2] . "-" . $date[1] . "-" . $date[0];
                return $newDate; 
            }
            case 'dateToLocale': {
                $date = explode("-", $var);
                $newDate = $date[2] . "/" . $date[1] . "/" . $date[0];
                return $newDate; 
            }
            default:
                break;
        }
    }

    /*public static function newThumb($w, $h, $orgSrc, $dstSrc)
    {
        $image_measure = 80;
        $icon_measure = 20;

        $icon = imagecreatefrompng($orgSrc);
        $image = imagecreatetruecolor($image_measure, $image_measure);

        $gray = imagecolorallocate($image, 106, 105, 113);
        $black = imagecolorallocate($image, 0, 0, 0);

        imagecolortransparent($image, $black);

        $rec_dimensions = self::resize(
            $image_measure, 
            $image_measure, 
            $w, 
            $h
        );
        
        $rec_coords = self::centralize(
            $image_measure, 
            $image_measure, 
            $rec_dimensions['width'], 
            $rec_dimensions['height']
        );

        imagefilledrectangle(
            $image, 
            $rec_coords['x'], 
            $rec_coords['y'], 
            $rec_coords['x'] + $rec_dimensions['width'], 
            $rec_coords['y'] + $rec_dimensions['height'], 
            $gray
        );

        $iconSize = getimagesize($orgSrc);
        $icon_dimensions = self::resize(
            $icon_measure, 
            $icon_measure, 
            $iconSize[1], 
            $iconSize[0]
        );
        
        self::centralize(
            $icon_measure, 
            $icon_measure, 
            $icon_dimensions['width'], 
            $icon_dimensions['height']
        );

        $icon_coords = self::centralize(
            $image_measure, 
            $image_measure, 
            $icon_measure, 
            $icon_measure
        );

        imagecopyresampled(
            $image, 
            $icon, 
            $icon_coords['x'], 
            $icon_coords['y'], 
            0, 
            0, 
            $icon_measure, 
            $icon_measure, 
            $iconSize[1], 
            $iconSize[0]
        );

        imagepng($image, $dstSrc, 0);
        imagedestroy($image);
    }
    
    protected static function resize($dst_width, $dst_height, $src_width, $src_height)
    {
        if ($src_width >= $src_height) {
            $prop = ($dst_width / $src_width);
    	} else {
                $prop = ($dst_height / $src_height);
    	}
            
    	$src_width = $prop * $src_width;
    	$src_height = $prop * $src_height;
            
    	return array("width" => $src_width, "height" => $src_height);
    }

    public static function resize($dst, $x, $y, $h, $w, $width = 150, $height = 150)
    {
        $size = getimagesize($dst);

        $thumb = imagecreatetruecolor($width, $height);

        $src = imagecreatefromjpeg($dst);

        imagecopyresampled($thumb, $src, 0, 0, $x, $y, $width, $height, $w, $h);

        imagejpeg($thumb, $dst);

        imagedestroy($thumb);
    }
    
    protected static function centralize($dst_width, $dst_height, $src_width, $src_height)
    {
        $x = ($dst_width / 2) - ($src_width / 2);
    	$y = ($dst_height / 2) - ($src_height / 2);
            
    	return array('x' => $x, 'y' => $y);
    }*/

    /**
     *
     * @method bool|array upload(array $file, string $dst, bool $returnName) Faz upload de uma imagem para o servidor.
     */

    public static function upload($file, $dst, $returnName = true)
    {
        $fileEx = explode(".", $file["name"]);
        $ext 	= array_pop($fileEx);
	
        $types = array(
            "image/jpg",
            "image/gif",
            "image/png",
            "image/jpeg",
            "image/x-png",
            "image/p-jpeg"
        );

        if (!empty($file["error"])) {
            switch ($file["error"]) {
                case "UPLOAD_ERR_INI_SIZE":
                    return false;
                case "UPLOAD_ERR_FORM_SIZE":
                    return false;
                case "UPLOAD_ERR_PARTIAL":
                    return false;
                case "UPLOAD_ERR_NO_TMP_DIR":
                    return false;
                case "UPLOAD_ERR_CANT_WRITE":
                    return false;
                case "UPLOAD_ERR_EXTENSION":
                    return false;
                default:
                    return false;
            }
        } elseif (!is_uploaded_file($file["tmp_name"])) {
            return array("msg" => "Possível ataque de upload de arquivo.");
        } elseif (!in_array($file["type"], $types)) {
            return array("msg" => "Tipo de arquivo não suportado.");
        } elseif (filesize($file["tmp_name"]) > MAX_UPLOAD_SIZE * 1024) {
            return array("msg" => "O arquivo excedeu o tamanho máximo permitido.");
        } elseif (!getimagesize($file["tmp_name"])) {
            return array("msg" => "O arquivo upado não é uma imagem.");
        } elseif (!preg_match("/^[jpg|png|jpeg|gif]{3,4}$/", $ext)) {
            return array("msg" => "A extensão do arquivo não é permitida.");
        } else {
            $filename = uniqid(time()) . "." . $ext;

            if (move_uploaded_file($file["tmp_name"], $dst . $filename)) {
                if ($returnName) {
                    return $filename;
                } else {
                    return true;
                }
            } else{
                return array("msg" => "Houve um erro ao fazer upload do arquivo, por favor, tente novamente.");
            }
        }
    }

    /**
     *
     * @method void newFile(string $path, string $html, string $css) Cria um arquivo com código HTML + CSS.
     */
    
    public static function newFile($path, $html = "", $css = "")
    {
        $code = "<style>"
              . $css
              . "</style>"
              . $html;
        
        $file = fopen($path, "w");
        fwrite($file, $code);
        fclose($file);
    }

    public static function getKeyFromUrlYoutube($url)
    {
        $itens = parse_url ($url);
        parse_str($itens['query'], $params);

        return $params["v"];
    }

    public static function validateCPF($cpf) {
        if(empty($cpf)) {
            return false;
        }

        $cpf = preg_replace('/[^0-9]/', '', $cpf);
        $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

        if (strlen($cpf) != 11) {
            return false;
        } else if (
            $cpf == '00000000000' || $cpf == '11111111111' || 
            $cpf == '22222222222' || $cpf == '33333333333' || 
            $cpf == '44444444444' || $cpf == '55555555555' || 
            $cpf == '66666666666' || $cpf == '77777777777' || 
            $cpf == '88888888888' || $cpf == '99999999999'
        ) {
            return false;
        } else {
            for ($t = 9; $t < 11; $t++) {
                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf{$c} * (($t + 1) - $c);
                }

                $d = ((10 * $d) % 11) % 10;
                
                if ($cpf{$c} != $d) {
                    return false;
                }
            }
     
            return true;
        }
    }
}
