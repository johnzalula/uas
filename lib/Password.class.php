<?php


class Password 
{
        private  $password = "";        

        public function __construct($pass = "")
        {
                if ($pass !== "")
                {
                        $this->password = $pass;
                }else
                {
                        $this->password = self::generate();
                }
        }

		public function getPassword()
		{
			return $this->password;
		}

		public function getCryptHash()
		{
			return crypt($this->password, sfConfig::get('app_crypt_salt'));
		}

		public function getLmHash()
		{
			/*return "Crypt_CHAR_MSv1 hack";
				$chap = new Crypt_CHAP_MSv1();
				$chap->password = $this->password;
				return bin2hex($chap->lmPasswordHash()); */
			$input = strtoupper(substr($this->password, 0, 14));
			$p1 = $this->LMhash_DESencrypt(substr($input, 0, 7));
			$p2 = $this->LMhash_DESencrypt(substr($input, 7, 7));

			return strtoupper($p1.$p2);


		}

		public function LMhash_DESencrypt()
		{

			$key = array();
			$tmp = array();
			$len = strlen($this->password);
			for($i=0; $i<7; ++$i)
          $tmp[] = $i < $len ? ord($this->password[$i]) : 0;
			$key[] = $tmp[0] & 254;
			$key[] = ($tmp[0]<< 7) | ($tmp[1] >> 1);
			$key[] = ($tmp[1]<< 6) | ($tmp[2] >> 2);
			$key[] = ($tmp[2]<< 5) | ($tmp[3] >> 3);
			$key[] = ($tmp[3]<< 4) | ($tmp[4] >> 4);
			$key[] = ($tmp[4]<< 3) | ($tmp[5] >> 5);
			$key[] = ($tmp[5]<< 2) | ($tmp[6] >> 6);
			$key[] = ($tmp[6]<< 1);	

			$is = mcrypt_get_iv_size(MCRYPT_DES, MCRYPT_MODE_ECB);
			$iv = mcrypt_create_iv($is, MCRYPT_RAND);
			$key_new = "";

			foreach($key as $k )
				$key_new .=chr($k);

			$LMHash = mcrypt_encrypt(MCRYPT_DES, $key_new, "KGS!@...", MCRYPT_MODE_ECB, $iv);

			return bin2hex($LMHash);
		}

		public function getNtHash()
		{
			/*return "Crypt_CHAP_MSv1 hack";
            $chap = new Crypt_CHAP_MSv1();
            $chap->password = $this->password;
            return bin2hex($chap->ntPasswordHash());*/

				$input = iconv('UTF-8', 'UTF-16LE', $this->password );
				$MD4Hash = hash('md4', $input);
				$NTLMHash = strtoupper($MD4Hash);
				
				return $NTLMHash;
        }

        public function getUnixHash()
        {
				mt_srand((double)microtime()*1000000);
				$salt = pack("cccc", mt_rand(), mt_rand(), mt_rand(), mt_rand());
				$hash = base64_encode(pack("H*", sha1($this->password.$salt)). $salt);

				return $hash;
            
				//return sha1($this->password);
        }
        
        private function generate()
        {
                $specialChars = array(
                   "$","@","#",")","(","[","]","?","=","%","!");
                $two_special = $specialChars[rand(0,10)].$specialChars[rand(0,10)];
                $two_number = chr(rand(48,57)).chr(rand(48,57));
                $two_capital = chr(rand(65,90)).chr(rand(65,90));
                $two_sletters = chr(rand(97,122)).chr(rand(97,122));
                $rnd_pass  =  $two_special . $two_number . $two_sletters . $two_capital;

                $this->password = str_shuffle($rnd_pass);
                return $this->password;
        }
}
?>

