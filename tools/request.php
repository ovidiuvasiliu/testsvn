<?php
    $loc = Localization::getInstance();
    //print_rr( $loc );
    
    //print_rr( $loc->getLocale() );
    //$loc->setLocale('ro_RO');
    //print_rr( $loc->getLocale() );
    
    //Loader::helper( 'default_language', 'multilingual' );
    //Loader::helper( 'section', 'multilingual' );
    
    //echo $_SESSION['c5Language']; die;
    $locale = $_SESSION['c5Language'];
    
    // site translations
    if (is_dir(DIR_LANGUAGES_SITE_INTERFACE)) {
        if (file_exists(DIR_LANGUAGES_SITE_INTERFACE . '/' . $locale . '.mo')) {
            $loc = Localization::getInstance();
            $loc->addSiteInterfaceLanguage($locale);
        }
    }
        
    //print_rr( $asd );
    
    echo t('TestTranslate!');
    //die;
?>
