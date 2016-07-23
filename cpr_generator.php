<!DOCTYPE html>
<html>
<head>
  <title>CPR numbers</title>
</heead>
<body>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    Day: <input type="text" placeholder="dd" name="day" />
    Month: <input type="text" placeholder="mm" name="month" />
    Year: <input type="text" placeholder="yyyy" name="year" />
    <input type="radio" name="gender" value="boy" /> Boy
    <input type="radio" name="gender" value="girl" /> Girl
    <input type="submit" name="submit" value="Generate CPR numbers!" />
  </form>
  <?php
  if(isset($_REQUEST['submit'])) {
     // form submitted - evaluate!
    // get values and make sure they are in the correct range
    $day = $_REQUEST['day'];
    $month = $_REQUEST['month'];

    if(substr($day,0,1) == 0) {
      $day = substr($day,1);
    }
    if(substr($month,0,1) == 0) {
      $month = substr($month,1);
    }
    $day = filter_var($day, FILTER_VALIDATE_INT, array("options" => array(
      "min_range" => 0,
      "max_range" => 31
    )));
    $month = filter_var($month, FILTER_VALIDATE_INT, array("options" => array(
      "min_range" => 0,
      "max_range" => 12
    )));
    $year = filter_input(INPUT_POST, 'year', FILTER_VALIDATE_INT, array("options" => array(
      "min_range" => 1858,
      "max_range" => 2036
    )));
    if($day && $month && $year) {
      // Was correct - now continue
      // Make 2 letter variable with year
      $yy = substr($year,2);

      $day = str_pad($day,2,"0",STR_PAD_LEFT);
      $month = str_pad($month,2,"0",STR_PAD_LEFT);

      // Combine first 6 numbers
      $date = $day . $month . $yy;
      // Now multiply by correct values
      $numbers = array();
      $multiplied = array();
      $values = array(4,3,2,7,6,5,4,3,2);
      for($i = 0;$i<=5;$i++) {
        $multiplied[$i] = substr($date,$i,1)*$values[$i];
        $numbers[$i] = substr($date,$i,1);
      }

      print_r($numbers);

      // Now get the first number
      $firstnumbers = array();
      if($year <= 1899) {
        array_push($firstnumbers,5,6,7,8);
      } elseif($year >= 1900 && $year <= 1999) {
        array_push($firstnumbers,0,1,2,3);
        if($year >= 1937 && $year <= 1999) {
          array_push($firstnumbers,4,9);
        }
      } elseif($year >= 2000 && $year <= 2036) {
        array_push($firstnumbers,4,5,6,7,8,9);
      }

      // Now we need to iterate over $firstnumbers
      foreach($firstnumbers as $fnum) {
        // Now multiply
        $fnummul = $fnum*$values[6];
        $numbers[6] = $fnum;
        $multiplied[6] = $fnummul;
        for($i=0;$i<=99;$i++) {
          if($i < 10) {
            $numbers[7] = 0;
            $multiplied[7] = $values[7]*0;
            $numbers[8] = $i;
            $multiplied[8] = $values[8]*$i;
          } else {
            $numbers[7] = substr($i,0,1);
            $multiplied[7] = substr($i,0,1)*$values[7];
            $numbers[8] = substr($i,1,1);
            $multiplied[8] = substr($i,1,1)*$values[8];
          }
          // Now with the complete number we can add them up
          foreach($multiplied as $mul) {
            $total += $mul;
          }
          $rest = $total % 11;
          if($rest > 1) {
            $last = 11-$rest;
          } elseif($rest == 0) {
            $last = 0;
          }
          if(isset($last)) {
            // Valid CPR found, check if boy or girl
            if(isset($_REQUEST['gender']) && $_REQUEST['gender'] == "boy") {
              if($last % 2 != 0) {
                // It is a boy
                foreach($numbers as $cpr_num) {
                  echo $cpr_num;
                }
                echo $last . "<br />";
              }
            } elseif(isset($_REQUEST['gender']) && $_REQUEST['gender'] == "girl") {
              if($last % 2 == 0) {
                foreach($numbers as $cpr_num) {
                  echo $cpr_num;
                }
                echo $last . "<br />";
              }
            }
          }
          $total = 0;
        }
      }
      ?>
      <h2>New way</h2>
      <p>Because of too few numbers there has been implemented a new way to generate numbers.<br />
        Here under is displayed the additional numbers this would generate.</p>
      <?php
      $boy_series = array(1,7,3,9,5,11);
      $girl_series = array(2,10,4,14,6,6);

      // First is it a boy or a girl?
      if(isset($_REQUEST['gender']) && $_REQUEST['gender'] == "boy") {
        // it's a boy! Now, construct the CPR number
        $i = 0;
        foreach($numbers as $num) {
          $cpr_test[] = $num;
          $i++;
          if($i>=5) {
            break;
          }
        }

        // This should be the correct date - test!!!
        foreach($cpr_test as $c_num) {
          echo $c_num;
        }
      }
    } else {
      echo "Wrong input";
    }
  }
  ?>
</body>
</html>
<?php
// Function to check if a CPR number exists in modulus
function check_modulus($cpr) {

}
?>
