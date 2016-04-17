function pollControl(siteUrl, justResults){
	var pollAnswerVal = $('input:radio[name=pollAnswerID]:checked').val();//Getting the value of a selected radio element.
	if ($('input:radio[name=pollAnswerID]:checked').length || justResults) {
		$("#pollAjaxLoader").show(); //show the ajax loader
		var controller = (justResults==true)?'/pollview/getPollResults/':'/pollview/doVote/';
		$.ajax({  
			//type: "POST",  
			url: siteUrl+controller+pollAnswerVal, 
			//data: { pollAnswerID: pollAnswerVal, action: "vote" },
			success: function(theResponse) {
				//alert(theResponse);
				//the functions.php returns a response like "1|13|#ffcc00-2|32|#00ff00-3|18|#cc0000-63" which the first number is the answerID, second is the points it has and third is the color for that answer's graph. The last number is the sum of all points for easilt calculating percentages.
				if (theResponse == "voted") {
					$("#pollAjaxLoader").hide(); //hide the ajax loader
					 getOut('نأسف لقد قمت بالتصويت من قبل');
				}else if (theResponse == "faild") {
					$("#pollAjaxLoader").hide(); //hide the ajax loader
					getOut('من فضلك حاول مرة أخرى');
				} else {
					var numberOfAnswers 		= (theResponse).split("-").length-1;//calculate the number of answers
					var splittedResponse 		= (theResponse).split("-");
					var pollAnswerTotalPoints 	= splittedResponse[numberOfAnswers];
			
					for (i=0;i<numberOfAnswers;i++)
					{
						var splittedAnswer 		= (splittedResponse[i]).split("|");
						var pollAnswerID 		= (splittedAnswer[0]);
						var pollAnswerPoints 	= (splittedAnswer[1]);
						var pollAnswerColor 	= (splittedAnswer[2]);
						var pollPercentage		= Math.round(100 * pollAnswerPoints / pollAnswerTotalPoints);
						$(".pollChart" + pollAnswerID).css("background-color",pollAnswerColor).animate({width:pollPercentage + "%"});
						$("#pollAnswer" + pollAnswerID).html(" (" + pollPercentage + "% - " + pollAnswerPoints + " صوت)");
						$("#pollRadioButton" + pollAnswerID).attr("disabled", "disabled"); //disable the radio buttons
					}
					$("#pollAjaxLoader").hide(); //hide the ajax loader again
					$("#pollSubmit").attr("disabled", "disabled"); //disable the vote button
					$("#votesResults").attr("disabled", "disabled"); //disable the vote results button
				}
			}  
		});  
		return false; 
	
	} else getOut('من فضلك اختر اجابة');
}

function getOut(message){
	$("#pollMessage").html(message).fadeTo("slow", 1, function(){
		setTimeout(function() {
			$("#pollMessage").fadeOut("slow");
		}, 3000);																		 
	});
	return false;
}
