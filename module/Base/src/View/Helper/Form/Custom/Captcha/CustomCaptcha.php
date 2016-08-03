<?php
namespace  Base\View\Helper\Form\Custom\Captcha;
 
//The orginial that we are intending to extend from
use Zend\Captcha\Image as CaptchaImage;
//The new extend verision were we override only what we need.
class CustomCaptcha extends CaptchaImage
{
 
 /**
  * !!! Override this function to point to the new helper.
  * Get helper name used to render captcha
  *
  * @return string
  */
 public function getHelperName()
 {
  return 'viewhelpercaptcha';
 }
 
 
}