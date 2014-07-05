<?php

/**
 * @file
 * The dcl_importer.module extends the invite.module with the ability to 
 * import contact lists from several email providers including Gmail, Yahoo!, AOL, Lycos, Myspace, & MSN Messanger Contacts.
 */

include ('dcl_wrapper.inc');

/** 
 * Implementation of hook_help(). 
 */ 
function dcl_importer_help($section) {

  switch ($section) {
    case 'admin/modules#description':
      return t('Allows users to import their contact lists from Gmail, Yahoo!, AOL, Lycos, Myspace, & MSN Messanger Contacts.');
  }
}

/**
 * Implementation of hook_perm().
 */
function dcl_importer_perm() {
  return array('DCL importer');
}

/**
 * Implementation of hook_menu().
 */
function dcl_importer_menu($may_cache) {
  global $user;
  $items = array();

  if (!$may_cache) {
    $items[] = array(
      'path' => 'invite/import',
      'title' => t('Import contacts'),
      'callback' => 'drupal_get_form',
      'callback arguments' => 'dcl_importer_form',
      'access' => user_access('DCL importer'),
      'type' => MENU_LOCAL_TASK,
    );
  }
  return $items;
}

function dcl_importer_form() {
   $form['dcl_importer']['info'] = array(
    '#type' => 'markup',
    '#value' => '<strong>Import contacts from GMail, Yahoo!, Lycos, AOL, Myspace, or MSN Messenger.</strong>',
  );

  $form['dcl_importer']['username'] = array(
    '#title' => 'Username',
    '#type' => 'textfield',
    '#default_value' => '',
    '#maxlength' => 44,
    '#required' => TRUE,
  );
  $options = array( 'G' => t('@gmail.com'), 'Y' => t('@yahoo.com'), 'L' => t('@lycos.com'), 'A' => t('@aol.com'), 'M' => t('MSN Messenger Contacts'), 'S' => t('Myspace') );
  $form['dcl_importer']['provider'] = array(
    '#type' => 'select', 
    '#title' => t('Service Provider'),
    '#default_value' => 'G',
    '#options' => $options,
    '#required' => TRUE,
    '#description' =>  t('The service provider that is hosting your contacts')
  );
  $form['dcl_importer']['password'] = array(
    '#title' => 'Password',
    '#type' => 'password',
    '#default_value' => '',
    '#maxlength' => 64,
    '#required' => TRUE,
  );
  $form['dcl_importer']['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Get My Contacts'),
  );
  return $form;
}

function dcl_importer_form_submit($form_id, $edit) {
  $provider = $edit['provider'];
  $password = $edit['password'];
  $username = explode('@', $edit['username']);
  if($provider == 'M' ) {
    $username[0] = $username[0].'@hotmail.com';
  } elseif( $provider == 'S' ) {
    $username[0] = $edit['username'];
  }

  $contacts = dcl_importer_get_contacts($username[0], $password, $provider);
  if ((count($contacts[0][0]) == 0) and (count($contacts[0][1]) == 0)) {
    $prov = '';
    $conb = 'contact';
    switch($provider) {
      case 'G': default: $prov = 'Gmail'; break;
      case 'A': $prov = 'AOL';   break;
      case 'Y': $prov = 'Yahoo!'; break;
      case 'L': $prov = 'Lycos'; break;
      case 'S': $prov = 'Myspace'; break;
      case 'M': $prov = 'MSN Messenger'; $conb = 'buddy'; break;
    }
    drupal_set_message(t( $prov.' login information is invalid or your '.$conb.' list is empty, if you are sure that your '.$conb.' list is not empty then please try again and make sure that you have typed the correct login information.'));
  }
  else {
    $contactList = array();
    // Check for any empty values and remove them from the final array that contains our contact list.
    foreach( $contacts[0][1] as $key => $email ) {
      $tmpEmail = trim($email);
      if(empty($tmpEmail)) {
        //typically do nothing here, just plain nothing to do for this element
      }else{
        $contactList[] = $tmpEmail;
      }
    }
    $_SESSION['invite_failed_emails'] = serialize($contactList);
    drupal_goto('invite');
  }
}
?>
