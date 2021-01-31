<?php

class Crypter
{
  var $algorithm = 'rijndael-256';
  var $string_mode = 'cfb';
  var $td;
  var $iv;
  var $ks;
  var $key;
  var $encrypted;
  var $decrypted;

  function  Crypter($key, $algorithm='', $strmode='')
  {
  	if(trim($algorithm) != '')
  	{
  	  $this->algorithm = $algorithm;
  	}
  	if(trim($strmode) != '')
  	{
  	  $this->string_mode = $strmode;
  	}
  	$this->init($key);
  }

  function init(&$key)
  {
  	$this->td = mcrypt_module_open($this->algorithm, '', $this->string_mode, '');
    $this->ks = mcrypt_enc_get_key_size($this->td);
    $this->key = substr(md5($key), 0, $this->ks);
  }

  function genericInit()
  {
  	mcrypt_generic_init($this->td, $this->key, $this->iv);
  }

  function genericDeInit()
  {
    mcrypt_generic_deinit($this->td);
  }

  function encrypt(&$str)
  {
  	$this->iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($this->td), MCRYPT_RAND);
  	$this->genericInit();
  	$encryptedStr = mcrypt_generic($this->td, $str);
  	$encryptedStr = substr($encryptedStr, 2, strlen($encryptedStr)).substr($encryptedStr, 0, 2);
  	$this->encrypted = addslashes(base64_encode($encryptedStr.$this->iv));
  	$this->genericDeInit();
  }

  function decrypt(&$encrypt_str)
  {
  	$encrypt_str = base64_decode(stripslashes($encrypt_str));
    $this->iv = substr($encrypt_str, (strlen($encrypt_str)-32), strlen($encrypt_str));
    $encrypt_str = substr($encrypt_str, 0, (strlen($encrypt_str)-32));
    $encrypt_str = substr($encrypt_str, (strlen($encrypt_str)-2), 2).substr($encrypt_str, 0, (strlen($encrypt_str)-2));
  	$this->genericInit();
  	$this->decrypted = mdecrypt_generic($this->td, $encrypt_str);
  	$this->genericDeInit();
  }

  function decryptValues(&$Array, $DecryptFields=array())
  {
    foreach($DecryptFields as $i => $name)
    {
      if(!isBlank($Array[$name]))
      {
        $Array[$name] = $this->getDecrypted($Array[$name]);
      }
    }
  }

  function close()
  {
    mcrypt_module_close($this->td);
  }

  function getEncrypted($str)
  {
    $this->encrypt($str);
    return trim($this->encrypted);
  }

  function getDecrypted($encrypt_str)
  {
    $this->decrypt($encrypt_str);
    return trim($this->decrypted);
  }
}

?>