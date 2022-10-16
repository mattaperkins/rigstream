#!/usr/local/bin/php
<?php
// find-rig.php - Program that locates your rigs on the serial ports and sets up some sym links for the devices. 
// wont work if you have two rigs of the same type, mignt not work with other setups other then mine

// Setup 
$radio = array("IC-7100","IC-9700","IC-7300"); 
$rigno = array(3070,3081,3073); 
$devdir = "/dev";
$linkdir = "/tmp/radios"; 
$rigctl = "/usr/local/bin/rigctl --set-conf=timeout=30,retry=0"; 
$rate = "19200"; 

if(file_exists($linkdir)){
	echo "Looks like we have already been run $linkdir exists\n"; 
	exit;
	}

mkdir($linkdir);
$no_radios = count($radio); 
$row =0 ;
while($row != $no_radios ){
	printf("Attempting to find %s (%s) \n",$radio[$row],$rigno[$row]);

	// Test all devices for a radio 
	if($handle = opendir($devdir)){
		while(false !== ($entry = readdir($handle))){
			if(strstr($entry,"cu.usbserial")){ 
				$cmdbuf = "$rigctl -m $rigno[$row] -r $devdir/$entry -s $rate -n 3 2>/dev/null";
				$result = shell_exec($cmdbuf); 
				if($result){ 
					if(strstr($result,"model:")){ 
						echo "	found on port $devdir/$entry\n"; 
						symlink("$devdir/$entry","$linkdir/$radio[$row]"); 
						break;
					}
				}
			}
		}
	}


	$row = $row + 1; 

}

