<?php

namespace App\Helpers;

class MyHelper
{
  public static function checked_array($errors, $index, $val)
  {
    if ($errors->any()) {
      if (old("category_ids.$index")) {
        return 'checked';
      }
    } else {
      if (!is_null($val)) {
        return 'checked';
      }
    }
  }
}

// if (!function_exists('checked_array')) {
//   function checked_array($errors, $index, $val)
//   {
//     if ($errors->any()) {
//       if (old("category_ids.$index")) {
//         return 'checked';
//       }
//     } else {
//       if (!is_null($val)) {
//         return 'checked';
//       }
//     }
//   }
// }