<?php
        require "schedule.php";
        require "connection.php";
        require "fbsetup.php";
        require "facebookhelper.php";
        require "function.php";


        function fillTimeSlot($course, $width, $height, $daysoffset, $times, $days, $image){
                $name = $course->name;
                $sectionnum = $course->section;
                $crn = $course->crn;
                foreach($course->times as $time){
                        $instructor = $time->instructor;
                        $starttime = $time->starttime;
                        $endtime = $time->endtime;
                        $onDays = $time->days;


                        $daysToFill;
                        for($i = 0; $i < strlen($onDays); $i++){
                                switch($onDays[$i]){
                                        case "M":
                                                $daysToFill[] = 0;
                                                break;
                                        case "T":
                                                $daysToFill[] = 1;
                                                break;
                                        case "W":
                                                $daysToFill[] = 2;
                                                break;
                                        case "R":
                                                $daysToFill[] = 3;
                                                break;
                                        case "F":
                                                $daysToFill[] = 4;
                                                break;
                                }
                        }

                        $starty = $daysoffset + ($height/count($times)/60)*($starttime - 480) + 1;
                        $endy = $daysoffset + ($height/count($times)/60)*($endtime - 480) + 1 - 2;

                        foreach($daysToFill as $slot){
                                $startx = $slot*($width-100)/count($days)+ 1 + 100;
                                $endx = $slot*($width-100)/count($days)+ 1 + ($width-100)/count($days) - 3 + 100;
                                
                                imagesetthickness($image, 2);
                                imagerectangle($image, $startx, $starty, $endx, $endy, imagecolorallocate($image, 0,0,0));
                                imagefilledrectangle($image,  $startx, $starty, $endx, $endy, imagecolorallocate($image, 250, 250, 250));
                                
                                $fontWidth = imagefontwidth(2);
                                $writename = (strlen($name)*$fontWidth >= $endx-$startx)  ? substr($name, 0, ($endx-$startx)/$fontWidth-3)."..." : $name;
                                $writeinstructor  = (strlen($instructor)*$fontWidth >= $endx-$startx)  ? substr($instructor, 0, ($endx-$startx)/$fontWidth-3)."..." : $instructor;

                                $black = imagecolorallocate($image, 0, 0,0);
                                imagestring($image, 2, $startx + 2, $starty + 2, $writename, $black);
                                imagestring($image, 2, $startx + 2, $starty + 2 + imagefontheight(2) + 2, $writeinstructor, $black);
                                imagestring($image, 2, $startx + 2, $starty + 2 + 2 * imagefontheight(2)  + 2, "Section ".$sectionnum, $black);
                                imagestring($image, 2, $startx + 2, $starty + 2 + 3 * imagefontheight(2)  + 2, "CRN:".$crn, $black);
                        }
                }
        }


        function generateImage($schedule){
                global $fb;
                $width = 800;
                $height = 600;
                $daysoffset = 30;


                $image = imagecreatetruecolor($width, $height+$daysoffset) or die("error");
                imagefill($image, 0, 0, imagecolorallocate($image, 200,200,200));

                $lightgray = imagecolorallocate($image, 150, 150, 150);

                $days = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday");
                $times = array("8 AM", "9 AM", "10 AM", "11 AM", "12 PM", "1 PM", "2 PM", "3 PM", "4 PM", "5 PM", "6 PM", "7 PM", "8 PM", "9 PM");



                for($i = 0; $i < count($days); $i++){
                        imagestring($image, 5, ($i*(($width-100)/count($days)))+100 + 35, 5, $days[$i], $lightgray);
                        imageline($image, ($i*(($width-100)/count($days)))+100, 0, ($i*(($width-100)/count($days)))+100, $height+$daysoffset, $lightgray);
                }


                $count = 0;
                for($i = $daysoffset; $i < $height; $i+=$height/count($times)){
                        imageline($image, 0, $i, $width, $i, $lightgray);
                        imagestring($image, 5, 10, $i+10, $times[$count++], $lightgray);
                }


                if(count($schedule->classList) == 0 || $schedule->classList == null) header("Location: index.php");
                foreach($schedule->classList as $course){
                        fillTimeSlot($course['data'], $width, $height, $daysoffset, $times, $days, $image);
                }
                

                imagepng($image, "scheduleimages/{$fb->getUser()}.png");
                imagedestroy($image);
                $fb->setFileUploadSupport(true);
                $fb->api("me/photos", "post", array("message" => "schedule", "source" => "@scheduleimages/{$fb->getUser()}.png"));
                header("Location: index.php?post=true");
        }
        generateImage($_SESSION['userschedule']);
?>
