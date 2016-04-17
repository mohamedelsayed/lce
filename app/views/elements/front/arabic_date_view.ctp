<?php
if(isset($date)){
	
	switch (date('D', strtotime($date))){
		
		case 'Sat':
		$arDay = "السبت";
		break;
		
		case 'Sun':
		$arDay = "الأحد";
		break;
		
		case 'Mon':
		$arDay = "الإثنين";
		break;
		
		case 'Tue':
		$arDay = "الثلاثاء";
		break;
		
		case 'Wed':
		$arDay = "الأربعاء";
		break;
		
		case 'Thu':
		$arDay = "الخميس";
		break;
		
		case 'Fri':
		$arDay = "الجمعة";
		break;
		
		default:
		$arDay = date('D', strtotime($date));
		break;
		
	}
	
	switch (date('n', strtotime($date))){
		
		case '1':
		$arMonth = "يناير";
		break;
		
		case '2':
		$arMonth = "فبراير";
		break;
		
		case '3':
		$arMonth = "مارس";
		break;
		
		case '4':
		$arMonth = "أبريل";
		break;
		
		case '5':
		$arMonth = "مايو";
		break;
		
		case '6':
		$arMonth = "يونيو";
		break;
		
		case '7':
		$arMonth = "يوليو";
		break;
		
		case '8':
		$arMonth = "أغسطس";
		break;
		
		case '9':
		$arMonth = "سبتمبر";
		break;
		
		case '10':
		$arMonth = "أكتوبر";
		break;
		
		case '11':
		$arMonth = "نوفمبر";
		break;
		
		case '12':
		$arMonth = "ديسمبر";
		break;
	}
	//print arabic date
	echo $arDay.', '.date('d', strtotime($date)).' '.$arMonth.' '.date('Y', strtotime($date));//.', '.date('H:i', strtotime($date));	
}
?>



