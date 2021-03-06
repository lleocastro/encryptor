<?php namespace Encryptor\Suite;

/*
 ===========================================================================
 = SMCrypter
 ===========================================================================
 =
 = Encrypts messages with a symmetric key using a simple crazy calculation 
 = and a bit of obscurity :p
 = 
 */

use \Encryptor\ASCIITable;
use \Encryptor\Suite\Disguise;
use \Encryptor\Suite\HashGenerator;
use \InvalidArgumentException;

/**
 * PHP Simple Message Crypter 
 * Encrypts messages with a key symmetric
 * @link https://github.com/lleocastro/encryptor
 * @license https://github.com/lleocastro/encryptor/blob/master/LICENSE
 * @author Leonardo Carvalho <leonardo_carvalho@outlook.com>
 * @copyright 2016 MIT License
 * @package \Encryptor;
 */
class SMCrypter extends Disguise
{
    /**
     * Values for key generation
     * @var encrypted strings
     */
    private $keyValueMin = 'RE13QVRNPT1BTXdB';
    private $keyValueMax = 'VE81a1RPPT1RTzVr';
    

    private $codex = [
        'U2U0MjVzo1cVFjSYdFRSJTYqJkViVkWywkea12UrpUbT1GZLV2V4hkSEpEaKRUQ0oURxUVVYxmTWdEZ2QVMSZUTVVTcWRlUO10
        asZDVrhjd','0UMKZEZwgWeXhlV2FVMvNTVsZEaR5GbSVWVopFZsZUTV5mTZRFWWxkSEpEaKRUQ0oURxEXUYBnTh1mT1QFWwJX
        TwETcWRlUO10asZDVtVVe','Q2aKRVTG50SM1WMLRWb4JnUI50TNNjTt50VopkVWZVSkV0azImMkRkSEpEaKRUQ0oURxUVVYh2
        ThxWR4RVbwZUTwETcWRlUO10asZDVtV1M','UFRsx2UUZkNOhUVzQ2aWNjUFRmNNRlWF1EbFVnUVpFVVp3a0wUMSVjSEpEaKRU
        Q0oURxEnWzQmTltWMzQlbwpVZrVTVaNDcaF2awk3VtZVN','kFMFJTVIFkMOhlSoJmMFJDVs5kelZFbypFSK1kUFhneSFjSqZF
        SCRkSEpEaKRUQ0oURxUVY6JkTlxmVzQFbSJlTVVTRWRlUO10asZDVuZla','M1V4NVTtBnNjZkQSl1aShUVXZFdiFjR1c1awh1
        Y65UbSpHZINFSWxmSEpEaKRUQ0oURxUVVUJkTWVEM3R1aSJXZFVTVWRlUO10asZDVuZlU'
    ];

    /**
     * Symmetric keys
     * @var encrypted string
     */
    private $key        = null;
    private $keyPrimary = null;
    private $keyCheck   = null;

    /**
     * For replace space on text
     * @var string
     */
    private $breakText = '#!';

    /**
     * Default construct
     */
    public function __construct()
    {
        $this->keyPrimary = (((((20239*9)/9)-((20009-230)+25)-2))-410);
        $this->keyCheck = (((((((((93133*4)*9)/4)/9)-930)-90000)*3)/3)-2190);
    }

    /**
     * Key Generator
     * Checks if there is already a key instance, if yes, returns, 
     * if not, create, it and then returns.
     * @return string encrypted $key
     */
    public function keyGenerator()
    {
        if($this->key == null):
            $this->key = $this->obscure(
            	(int) mt_rand(
            	    $this->illumin($this->keyValueMin), 
            	    $this->illumin($this->keyValueMax)
            	)
            );
            return $this->key;
        endif;

        return $this->key;
    }
    
    /**
     * Key Validator
     * Verifies that the key manually provided on method 'encode()' follows the 
     * standards of a valid key.
     * @param ((string) or (int)) $key
     * @return (int) $key, or (boolean) false
     */
    private function keyValidator($key)
    {
        if(((is_int($key)) && ($key >= $this->illumin($this->keyValueMin)) && 
                              ($key <= $this->illumin($this->keyValueMax)))):
            return $key;
        elseif((is_string($key)) && ($key != '') && (strlen($key) == 16)):
            return $this->illumin($key);
        endif;

        throw new InvalidArgumentException('Invalid key!');   
    }

    /**
     * Encryptor Messages
     * Get the numerical value of any character and encrypts with key.
     * @param ((string) or (int)) $key for encryption
     * @param (int) $value for encryption
     * @return (int) encrypted $value
     */
    public function encode($key, $text)
    {
        $text = (string) trim(htmlentities($text));
        return $this->translator(
            trim(htmlentities(strip_tags($this->keyValidator($key)))), 
            str_split(str_replace(' ', $this->breakText, $text))
        );
    }
    
    /**
     * Decryptor Messages
     * Get the value encrypted and decryption with the key.
     * @param ((string) or (int)) $key used in encrypting
     * @param (int) $value for decryption
     * @return (int) original value
     */
    public function decode($key, $text)
    {
        $text = (string) trim(htmlentities($text));
        return $this->reverse(
            trim(htmlentities(strip_tags($this->keyValidator($key)))), 
            explode(' ', $text)
        );
    }

    /**
     * Logic from Encryption
     * Crazy calculation for encryption. #sqn #haha
     * @param (int) (optional) $key for encryption
     * @param (int) $value for encryption
     * @return (int) encrypted $value
     */
    private function encrypter($key='', $value)
    {
    	$key = (($key=='')?$this->illumin($key):$key);
        return ((($value*$key)*$key)/$key);
        //return $this->calc("((({$value}{$this->getCodeX()[1]}{$key}){$this->getCodeX()[1]}{$key}){$this->getCodeX()[0]}{$key})");
    }
    
    /**
     * Logic from Decryption
     * Crazy calculation for decryption. #sqn #haha
     * @param (int) (optional) $key used in encrypting
     * @param (int) $value for decryption
     * @return (int) original value
     */
    private function decrypter($key='', $value)
    {
    	$key = (($key=='')?$this->illumin($key):$key);
        return ((($value/$key)/$key)*$key);
        //return $this->calc("((({$value}{$this->getCodeX()[0]}{$key}){$this->getCodeX()[0]}{$key}){$this->getCodeX()[1]}{$key})");
    }

    /**
     * Translate the Text to Numbers
     * @param (int) $key for encryption
     * @param (array) $characters 
     * @return (array) translated values
     */
    private function translator($key, array $characters)
    {
        $charactersConverted = [];
        for($i = 0; $i <= count($characters); $i++):
            for($x = 0; $x <= ASCIITable::sizeTable(); $x++):
                if(($characters[$i]) == (ASCIITable::getTableIndex($x))):
                    $charactersConverted[$i] = $this->encrypter(
                        $key, ASCIITable::getChar(ASCIITable::getTableIndex($x)));
                endif;
            endfor;
        endfor;
        return implode(' ', array_filter($charactersConverted));
    }

    /**
     * Translate the Numbers to Text
     * @param (int) $key for decryption
     * @param (array) $characters 
     * @return (array) translated values
     */
    private function reverse($key, array $charactersConverted)
    {
        $characters = [];
        for($i = 0; $i <= count($charactersConverted); $i++):
            for($x = 0; $x <= ASCIITable::sizeTable(); $x++):           
                if(("{$this->decrypter($key, $charactersConverted[$i])}")
                              == (ASCIITable::getChar(ASCIITable::getTableIndex($x)))):
                    $characters[$i] = ASCIITable::getTableIndex($x);
                endif;
            endfor;
        endfor;
        return str_replace($this->breakText, ' ', implode('', $characters));
    }

    public function getCodeX()
    {
        $exthor = [];
        $someThing = [];
        $operatorsExt = ['+', '-', '/', '%', '^', '*'];
        $hash = new HashGenerator();
        $x = 0;

        for($i = 0; $i <= 5; $i++):
            if($hash->isEquals($operatorsExt[$i], $this->codex[$i])):
                $exthor[$x] = $operatorsExt[$i];
                $x++;
            endif;
        endfor;

        $exthor[23] = $exthor[2];
        $exthor[13] = $exthor[5];
        
        // for($y = 0; $y <= count($exthor)-2; $y++):
        //     //$someThing[$y] .= $operatorsExt[$x];
        //     //$exthor[$y] = $exthor[$y];
        // endfor;
        
        $exthor[0] = $exthor[$this->keyPrimary];
        $exthor[1] = $exthor[$this->keyCheck];
        //$exthor .= $someThing;
        unset($someThing);

        return $exthor;
    }

    public function calc($strCalc)
    {
        $compute = create_function('', 'return (' . trim($strCalc) . ');' );
        return (float) 0 + $compute();
    }

}