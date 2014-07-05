<?php

	/************************************************************************************************
	 * Lycos.com Contact List Grabber								*
	 * Version 1.0											*
	 * Released 1th June, 2007									*
	 * Author: Ma'moon Al-akash ( soosas@gmail.com )						*
	 *												*
	 * This program is free software; you can redistribute it and/or				*
	 * modify it under the terms of the GNU General Public License					*
	 * as published by the Free Software Foundation; either version 2				*
	 * of the License, or (at your option) any later version.					*
	 *												*
	 * This program is distributed in the hope that it will be useful,				*
	 * but WITHOUT ANY WARRANTY; without even the implied warranty of				*
	 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the				*
	 * GNU General Public License for more details.							*
	 *												*
	 * You should have received a copy of the GNU General Public License				*
	 * along with this program; if not, write to the Free Software					*
	 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.		*
	 ************************************************************************************************/

	/**
	 * This Class is used to grab the Contact List of a lycos.com account
	 */
	class grabLycos{

		// Privates
		var $_username;
		var $_password;

		/**
		 * Constructor of the class to initialize the privates
		 * @param $username, the username for the lycos account
		 * @param $password, the password for the lycos account
		 * @return VOID, only used to initialize the privates
		 */
		function grabLycos( $username, $password ){

			$username = trim( $username );
			$password = trim( $password );
			if ( !empty( $username ) )
				$this->_username = $username;
			else
				die( 'Please provide your Lycos username' );
			if ( !empty( $password ) )
				$this->_password = $password;
			else
				die( 'Please provide your Lycos password' );
			
		}

		/**
		 * Returns username of the Lycos account ( $this->_username )
		 * @return String, $this->_username
		 */
		function _getUsername(){
			return $this->_username;
		}

		/**
		 * Returns password of the Lycos account ( $this->_password )
		 * @return String, $this->_password
		 */
		function _getPassword(){
			return $this->_password;
		}

		/**
		 * Grabs the Contact List from the Lycos account
		 * @return Array, an array that contains the grabbed contact list from Lycos.com
		 */
		function getContactList(){
			// login to lycos and authenticate the user ...
			$cookieFile	= '/var/tmp/lycos_'.$this->_getUsername().'_cookiejar.txt';
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,"https://registration.lycos.com/login.php?m_PR=27");
			curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
			curl_setopt($ch, CURLOPT_COOKIEFILE,$cookieFile);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1");
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$name = urlencode( $this->_getUsername() );
			$pass = urlencode( $this->_getPassword() );
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS,"m_PR=27&m_CBURL=http%3A%2F%2Fmail.lycos.com&m_U=$name&m_P=$pass&login=Sign+In");
			curl_exec($ch);

			// navigate to the address book ...
			curl_setopt($ch, CURLOPT_URL,"http://mail.lycos.com/lycos/addrbook/ViewAddrBook.lycos");
			$output = curl_exec($ch);
			curl_close( $ch );
			// now filter the output and get the contact list ...
			preg_match_all( '/<tbody>(.*?)<\/tbody>/s', $output, $trs );
			$grabbedArea = $trs[0][0];
			preg_match_all( '/<td width=\"170\" nowrap>(.*?)<\/td>/s', $grabbedArea, $emails );
			preg_match_all( '/<td width=\"100%\" nowrap>(.*?)<\/td>/s',$grabbedArea, $names );
			$contactList = array();
			foreach( $names[1] as $key => $name ){
				$contactList[$name] = $emails[1][$key];
			}
			// before we exit from here we should delete the cookie file ...
			@unlink( $cookieFile );

			// now safely return our contacts :-)
			return $contactList;
		}
	}
?>
