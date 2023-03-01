/* To add noOfDays in number to entered date:inDate(format 'DD-MON-YYYY') :: Posted by - Chitta on 24 Sept 10 */
function addDaysToDate(inDate, noOfDays)
{
	var tempToDate="";
	tempToDate = extractMonthInNumber(inDate.substr(3, 3))+"/"+inDate.substr(0, 2)+"/"+inDate.substr(7, 4);
	var d = new Date(tempToDate);
	d.setDate(d.getDate()+noOfDays);
	var temp =  d.getDate();
	if((temp+"").length == 1){temp = "0"+temp;}
	tempToDate = temp+"-"+returnMonthInString(d.getMonth()+1)+"-"+d.getFullYear();
	return tempToDate;
}

/* Method to get no of days between two dates :: Posted by - Chitta on 24 Sept 10 */
function daysBetweenDates(date1, date2)
{
	var date1_obj = new Date(date1), 
		date2_obj = new Date(date2), 
		time1 = date1_obj.getTime(), 
		time2 = date2_obj.getTime(), 
		time_diff = time1-time2,
		days_diff = Math.floor((time1-time2)/(1000*60*60*24));
	return days_diff;
};

/* To return month in three digit string (eg. 'JAN', 'OCT') :: Posted by - Chitta on 24 Sept 10 */
function returnMonthInString(monthInNumber)
{
	var smonth="";
	if(monthInNumber==1)		smonth="JAN";
	else if(monthInNumber==2)	smonth="FEB";
	else if(monthInNumber==3)	smonth="MAR";
	else if(monthInNumber==4)	smonth="APR";
	else if(monthInNumber==5)	smonth="MAY";
	else if(monthInNumber==6)	smonth="JUN";
	else if(monthInNumber==7)	smonth="JUL";
	else if(monthInNumber==8)	smonth="AUG";
	else if(monthInNumber==9)	smonth="SEP";
	else if(monthInNumber==10)	smonth="OCT";
	else if(monthInNumber==11)	smonth="NOV";
	else if(monthInNumber==12)	smonth="DEC";
	return smonth;
}  

/* To validate all decimal text-boxes :: Created by - Tapan on 05 Apr 09 */
function validateDecimalField(fieldId,decimalLength,maxLength,msgLabel)
{
	// Decimal Length : Scale of the datatype of the field.
	// Max Length : Max Length including decimal.
	if(fieldId.value != "")
	{
		var fieldValue = fieldId.value;
		if(isNaN(fieldValue))
		{
			alert ("Please enter a decimal value for "+msgLabel+".");
			fieldId.value = "";
			fieldId.focus();	
			return false;
		}
		var result = (parseFloat(fieldValue)).toFixed(decimalLength);
		fieldId.value = result;
		if(result.length > maxLength)
		{
			alert ("Invalid entry found for "+msgLabel+".");
			fieldId.focus();	
			return false;
		}
	}
}  
/* *********** ######### BEGIN : Functions for common ADVANCED SEARCH options ######### *********** */
var pageMenuId = "";
// ##### Load the Common Advanced Search Component #####
function loadAdvSearchPage(menuItemId)
{
	pageMenuId = menuItemId;
	if(document.getElementById("retValueToShow") != null)
	{
		if(document.getElementById("retValueToShow").value.toUpperCase() == 'RET')
		{
			document.getElementById("AdvSearchRow").style.display = '';
			return;
		}
	}
	getXmlHttpRequest();
	var url="/"+webContext+"/jsps/loadAdvSearchOptions.kspl";
	url = url+"?menuItemPageId="+encodeURIComponent(menuItemId);
	request.open("GET",url, true);
	request.onreadystatechange = callBack_advSearch;
	request.send(null);
}
function callBack_advSearch()
{
	document.getElementById("AdvSearchRow").style.display = '';
	document.getElementById("AdvSearchPageId").innerHTML = "<center><font face='Verdana' size='1' color='red'><b>Please wait while the Advanced Search options are being populated ...</b></font></center>";
	if(request.readyState==4)
	{
		document.getElementById("AdvSearchPageId").innerHTML = request.responseText;
		if(document.getElementById("txtSrchOptValArr"+0) != null)
			document.getElementById("txtSrchOptValArr"+0).focus();
		document.getElementById("retValueToShow").value = "";
		body_onLoad();
	}
}
// ##### Hide the Component Page #####
function hideAdvSearchPage()
{
	document.getElementById("retValueToShow").value = "RET";
	document.getElementById("AdvSearchRow").style.display = 'none';
}
// ##### Reset the Search options #####
function resetAdvSearchPage()
{
	document.getElementById("retValueToShow").value = "";
	loadAdvSearchPage(pageMenuId);
}
/* **************** ######### END : Functions for ADVANCED SEARCH options ######### **************** */


/* ################## Method for positioning cursor at the 1st field ######################### */

function positionCursor()
{
	if (!document.forms[1].elements[0].disabled )
	{
		document.forms[1].elements[0].focus();
	}
}

/* ##################### Method for checking the max length of a field ###################### */

function checkMaxLength(field,maxlen)
{
	if(field.value.length > maxlen)
	{
		field.value =  field.value.substring(0,maxlen);
		showMsg(maxlength,maxlen);
		field.focus();

	}
}

/* ##################### Method for checking the min length of a field ###################### */

/*function checkMinLength(field,minlen)
{
	if(field.value.length < minlen)
	{

		field.value =  field.value.substring(0,minlen);

		showMsg(minlength,minlen);

		field.focus();


	}
}
*/
/* ############## Method for restricting a numeric value #################### */

function checkNonNumeric(field)
{

	if(!isNaN(field.value))
	{
		if(field.value=="")
		{
			return true;
		}
		else
		{
			showMsg(nonNumeric);
			field.value="";
			field.focus() ;
			return false;
		}
	}
	else
	{
		return true;
	}
}


/* ############## Method for checking a decimal value #################### */
function checkDecimal(field)
{
	if(field.value.indexOf(".")!=-1)
	{
		showMsg(decimalValue);
		field.value="";
		field.focus() ;
		return false;
	}
	else
	{
		return true;
	}
}
/* ############## Method for restricting a non-numeric value #################### */

function checkNumeric(field)
{
	if(isNaN(field.value))
	{
		showMsg(numeric);
		field.value="";
		field.focus();
		return false;
	}
	else
	{
		return true;
	}
}

/* ############## Method for checking a negative value #################### */

function checkNegative(field)
{
	if(field.value.indexOf("-")!= -1)
	{
		showMsg(negative);
		field.value="";
		field.focus();
		return false;
	}
	else
	{
		return true;
	}
}


/* ########################## METHODS RELATED TO COMBO BOX ################################ */

/* To return the value of the selected option in given combo box*/

function getOption(field)
{
    var selector = document.getElementById(field);
    var selected = selector.selectedIndex;
    if (selected < 0) return null;
    var value = selector.options[selected].value;
    return value;
}

/* To append an option to a combo box*/

function appendOption(field, prompt, val)
{
	 field.options[field.options.length] =  new Option(prompt, val);
}


/* To insert option in sorted position, ignoring initial fixed area */
function insertOption(Combo, itemText, itemVal, Pos)
{
	var inserted=false;
	var insertpos=-1;

	// add blank row
	Combo.length++;

	//if first position
	if (Pos==-1)
	{
		for (var i=0; i<Combo.length-1; i++)
		{	if (Combo.options[i].text.toLowerCase()>itemText.toLowerCase())
			{
				insertpos=i;
				break;
			}
		}
	}
	else
	{
		insertpos=Pos;
	}

	// shift part of array down one then insert new row
	if (insertpos!=-1)
	{	for (i=Combo.length-1; i>insertpos; i--)
		{
			Combo.options[i].value=Combo.options[i-1].value;
			Combo.options[i].text=Combo.options[i-1].text;
		}
		Combo.options[insertpos].text=itemText.value;
		Combo.options[insertpos].value=itemVal;
	}
	else
	// append new row
	{
		insertpos=Combo.length-1;
		Combo.options[insertpos].text=itemText.value;
		Combo.options[insertpos].value=itemVal;
	}

	return insertpos;
}
		/* To delete option with given value from given selector */

function deleteOption(field, val)
{
    var selector = document.getElementById(field);
    var options = selector.options;
    for (var i = 0; i < options.length; i++)
    {
        if (options[i].value == val)
        {
            options[i] = null;
            break;
        }
    }
}

/* Truncate a selector to have this many options */

function truncateOptions(field, count)
{
    var options = field.options;
    while (options.length > count)
	{
		options[options.length-1] = null;
	}
}

/* To Copy selected items of one list box to another */
function copySelectedItems(srcCombo, destCombo)
{
	var numItems = 0;
	var curPos = destCombo.options.length;
	var srcLen = srcCombo.options.length;

	for (var i=0; i<srcCombo.options.length; i++)
	{
		if (srcCombo.options[i].selected)
		{
			numItems++;
		}
	}
	destCombo.options.length+=numItems;
	for (var i=0; i<srcCombo.options.length; i++)
	{
		if (srcCombo.options[i].selected==true)
		{
			destCombo.options[curPos].text=srcCombo.options[i].text;
			destCombo.options[curPos].value=srcCombo.options[i].value;
			if(srcCombo.options[i].getAttribute("othValue"))
			destCombo.options[curPos].setAttribute("othValue",srcCombo.options[i].getAttribute("othValue"));
			curPos++;
		}
	}

}

/* To Move selected items of one list box to another */
function moveSelectedItems(srcComboId, destComboId)
{
	var numItems = 0;
	var srcCombo = document.getElementById(srcComboId);
	var destCombo = document.getElementById(destComboId);
	if(destCombo == null)
	{
		destCombo = destComboId;
	}
	if(srcCombo == null)
	{
		srcCombo = srcComboId;
	}
	var curPos = destCombo.options.length;
	var srcLen = srcCombo.options.length;
	for (var i=0; i<srcCombo.options.length; i++)
	{
		for (var j=0; j<destCombo.options.length; j++)
		{
			if(srcCombo.options[i].selected == true && srcCombo.options[i].value == destCombo.options[j].value)
			{
				alert("Duplicate item can not be moved ...");
				return false;
			}
		}
	}
	for (var i=0; i<srcCombo.options.length; i++)
	{
		if (srcCombo.options[i].selected)
		{
			numItems++;
		}
	}
	destCombo.options.length+=numItems;
	for (var i=0; i<srcCombo.options.length; i++)
	{
		if (srcCombo.options[i].selected==true)
		{
			destCombo.options[curPos].text=srcCombo.options[i].text;
			destCombo.options[curPos].value=srcCombo.options[i].value;
			if(srcCombo.options[i].getAttribute("othValue"))
			destCombo.options[curPos].setAttribute("othValue",srcCombo.options[i].getAttribute("othValue"));
			curPos++;
		}
	}	
	// remove the selected items from the source listbox */
	for (i=srcLen-1; i>=0; i--)
		if (srcCombo.options[i].selected) srcCombo.options[i]=null;

	destCombo.focus();
}

/* Move all the elements of a cmbobox to another  */
function moveAllItem(srcCombo, destCombo)
{
	for (var i=0; i<srcCombo.options.length; i++)
	{
		for (var j=0; j<destCombo.options.length; j++)
		{
			if(srcCombo.options[i].value == destCombo.options[j].value)
			{
				alert("Duplicate item can not be moved ...");
				return false;
			}
		}
	}

	var numItems = srcCombo.options.length;
	var curPos = destCombo.options.length;
	var srcLen = srcCombo.options.length;
	destCombo.options.length+=numItems;

	for (var i=0; i<srcCombo.options.length; i++)
	{
		destCombo.options[curPos].text=srcCombo.options[i].text;
		destCombo.options[curPos].value=srcCombo.options[i].value;
		if(srcCombo.options[i].getAttribute("othValue"))
		destCombo.options[curPos].setAttribute("othValue",srcCombo.options[i].getAttribute("othValue"));
		curPos++;
	}
	// remove the selected items from the source listbox */
	for (i=srcLen-1; i>=0; i--)
	{
		srcCombo.options[i]=null;
	}
	destCombo.focus();
}
//to move an option up in combobox
function moveUp(field)
{
	var i = field.selectedIndex;
	if(i>0)
	{
		var upperText = field.options[i-1].text;
		var upperValue=field.options[i-1].value;
		var currentText = field.options[i].text;
		var currentValue = field.options[i].value;
		field.options[i-1]. text = currentText;
		field.options[i-1]. value =currentValue;
		field.options[i].text = upperText;
		field.options[i].value = upperValue;
		field.selectedIndex=i-1;
	}
}
//to move an option down in combobox
function moveDown(field)
{
	var i = field.selectedIndex;
	if(i < field.length-1)
	{
		var lowerText = field.options[i+1].text;
		var lowerValue=field.options[i+1].value;
		var currentText = field.options[i].text;
		var currentValue = field.options[i].value;
		field.options[i+1]. text = currentText;
		field.options[i+1]. value =currentValue;
		field.options[i].text = lowerText;
		field.options[i].value = lowerValue;
		field.selectedIndex=i+1;
	}
}
//******************Methods for grid manipulation**********************
function dropDownToDorpDownAll(srcCombo,destCombo)
{
	removeAllFromDropDown(destCombo);
	for (var i=0; i<srcCombo.options.length; i++)
	{
		var newOption = document.createElement("OPTION");
		newOption.text= srcCombo.options[i].text;
		newOption.value=srcCombo.options[i].value;
		destCombo.options.add(newOption,i);
	}

}
function removeAllFromDropDown(comboField)
{
	while (comboField.options.length > 0) {
		comboField.remove(0);
	}
}
//******************Methods for grid manipulation**********************
function dropDownToDorpDown(srcCombo,destCombo)
{
	var newOption = document.createElement("OPTION");
	newOption.text= srcCombo.options[srcCombo.selectedIndex].text;
	newOption.value=srcCombo.value;
	destCombo.options.add(newOption,destCombo.length);
}
function textBoxToDropDown(textField,comboField)
{
	var newOption = document.createElement("OPTION");
	newOption.text= textField.value;
	newOption.value=textField.value;
	comboField.options.add(newOption,comboField.length);
	textField.value="";
}
function removeFromDropDown(comboField)
{
	var i = comboField.selectedIndex;
	comboField.remove(i);
}
function selectListRow(comboArr,combo)
{
   for(i=0;i<comboArr.length;i++)
   {
	   comboArr[i].selectedIndex=combo.selectedIndex;
   }
}


function selectItem(cmb,val)
{
	for(i=0;i< cmb.length;i++)
	{
		if(cmb.options[i].value==val)
		{
			cmb.options[i].selected= true;
		}
	}
}

/* ########################### METHODS FOR CHECK BOXES ##################################### */

		/*Return whether chekcbox "id" is currently checked */

function getCheckbox(field)
{
	return document.getElementById(field).checked;
}

	/*Set the "checked" attribute of the given checkbox*/

function setCheckbox(field, stats)
{
   document.getElementById(field).checked = stats;
}


/* ###################### METHODS FOR STRING MANIPULATIONS ################################### */
											/* To Validate Phone No */
function checkPhoneNo(field)
{
	if(isNaN(field.value) && (field.value!='+'))
	{
		showMsg(numeric);
		field.value="";
		field.focus();
		return false;
	}
	else
	{
		return true;
	}
}

/* To Validate email id */
function isValidEmail(e)
{
	// assume an email address cannot start with an @ or white space, but it
	// must contain the @ character followed by groups of alphanumerics and '-'
	// followed by the dot character '.'
	// It must end with 2 or 3 alphanumerics.
	//
	var alnum="a-zA-Z0-9";
	//exp="^[^@\\s]+@(["+alnum+"+\\-]+\\.)+["+alnum+"]["+alnum+"]["+alnum+"]?$";
	//exp = "[a-z0-9._%+-]+@[a-z0-9.-]+\.[A-Z][a-z]{2,3}$";
	//exp = "/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/";
	exp =/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	emailregexp = new RegExp(exp);
	result = e.match(emailregexp);  
	if (result != null)
	{
		return true;
	}
	else
	{
		alert("Not a valid Email");
		return false;
	}
}
function isValidEmailNew(e)
{
	
	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	emailregexp = new RegExp(reg);
	result = e.match(emailregexp);  
	if (result != null)
	{
		return true;
	}
	else
	{
		alert("Not a valid Email");
		return false;
	}
}
	/* To convert a string to lowercase with 1st letter capitalised */

function firstCaps(str)
{
	var retStr = "";
	var firstChar = str.value.charAt(0);
	if (str.value.length==1)
	{

		retStr = firstChar.toUpperCase();

	}
	else
	{
		retStr = firstChar.toUpperCase() + str.value.slice(1).toLowerCase();
	}
	alert("<This function returns : "+retStr+">");
	return(retStr);
}

		/* To remove leading and trailing spaces */

function trim(val)
{
	var trimmed="";
	var left=0;
	// strip leading spaces
    for(var i = 0; i < val.length; i++)
	{
        var curChar = val.charAt(i);
        if (curChar == ' ')
        {
			left++;
		}
		else
		{
			break;
		}
    }
    var right=val.length;
   // strip trailing spaces
  	for (var i = val.length-1 ; i>=0; i--)
    {
		var curChar = val.charAt(i);
		if (curChar == ' ')
		{
			right--;
		}
		else
		{
			break;
		}
    }

    trimmed = 	val.substr(left,(right-left));
	return trimmed;
}

	/* To convert a String to Title Case ( ex: " Kalinga Software Pvt. Lts.") and converts the underscores to blank space */

function titleCase(str)
{
	var formatted = "";
	var curChar = "";
	var firstChar = true;
    for(var i = 0; i < str.value.length; i++)
    {
        curChar = str.value.charAt(i);
        if (curChar == "_"){curChar=" ";}
        if (firstChar==true)
        {
	        formatted=formatted+curChar.toUpperCase();
	        firstChar=false;
	    }
        else
        {
	        formatted=formatted+curChar.toLowerCase();
	    }
        if (curChar == " ")
        {
	        firstChar=true;
	    }
    }
    alert("<This function returns : "+formatted+">");
    return formatted;
}

			/* To sort 2 values irrespective of their case */


function caseSort(a, b)
{
    var la = a.value.toLowerCase();
    var lb = b.value.toLowerCase();
    var retVal = (la < lb ? a : (la > lb ? b : "equal"));
    alert("<This Function Returns the lower order element in dictionary:"+retVal.value+">");
    return retVal;

}

			/*  To allow only one space(" ") in between the words */

function checkSpace(field)
{

	var content=field.value;

	var result="";
	for(var i = 0; i < content.length; i++)
	{
		curChar = content.charAt(i);
		nxtChar = content.charAt(i+1);
        if ((curChar == ' ')&&(curChar ==nxtChar))
        {
			curChar = "";
		}
		result=result+curChar;
	}
	return(result);

}

/* ########################## MANIPULATION WITH DATE & TIME #################################### */

		/* To check whether a leap year */

function isLeapYear(inputYear)
{
	if (inputYear.value % 100 == 0)
	{
		if (inputYear.value % 400 == 0)
		{
			//alert("<Returns Leap Year>");
			return true;
		}
		else
		{
			//alert("<Returns Not a Leap Year>");
			return false;
		}
	}
	else if ((inputYear.value % 4) == 0)
		{
			//alert("<Returns Leap Year>");
			return true;
		}
	else
	//alert("<Returns Not a Leap Year>");
	return false;
}

		/* Method for checking whether a startDate is not greater than endDate */

function compareDate(startDate,endDate)
{
	/*
	var sDate = "";
	var eDate = "";
	var array=new Array(3);

	if(endDate.toString().indexOf('-')==-1)
	{
		var eYear = endDate.getYear();
		var eMonth=endDate.getMonth()+1;
		var eDay=endDate.getDate();

		endYear=parseInt(eYear);
		endMonth=parseInt(eMonth);
		endDay=parseInt(eDay);
	}
	else
	{
		var eYear = endDate.substring(7,11);
		var eMonth=endDate.substring(3,6);
		var eDay=endDate.substring(0,2);

		eIntMonth = extractMonthInNumber(eMonth);
		alert(eIntMonth);
		eDate=new Date(eYear,parseInt(eIntMonth),eDay);
		alert("eDate-"+eDate);
		endYear=parseInt(eDate.getYear());
		endMonth=parseInt(eDate.getMonth());
		endDay=parseInt(eDate.getDate());
	}


	//var selectedDate="25-NOV-2004"

	var sYear=startDate.substring(7,11);
	var sMonth=startDate.substring(3,6);
	var sDay=startDate.substring(0,2);


	var sIntMonth=extractMonthInNumber(sMonth);
	var sDate=new Date(sYear,parseInt(sIntMonth)-1,sDay);

	var startYear=parseInt(sDate.getYear())	;
	var startMonth=parseInt(sDate.getMonth());
	var startDay=parseInt(sDate.getDate());


	if(startYear>endYear)
	{
		//alert("Date of Birth must be less than Current Date.");
		return false
	}
	else if(startYear == endYear && startMonth>endMonth)
	{

		//alert("Date of Birth must be less than Current Date.");
		return false;
	}
	else if(startYear == endYear && startMonth==endMonth && startDay>endDay)
	{

		//alert("Date of Birth must be less than Current Date.");
		return false;
	}
	else
	{
		return true;
	}
*/
	var sDate = "";
	var eDate = "";
	var array=new Array(3);

	if(endDate.toString().indexOf('-')==-1)
	{
		var eYear = endDate.getYear();
		var eMonth=endDate.getMonth()+1;
		var eDay=endDate.getDate();
		
		endYear=parseInt(eYear);
		endMonth=parseInt(eMonth);
		endDay=parseInt(eDay);
}
	else
	{
		
		var eYear = endDate.substring(7,11);
		var eMonth=endDate.substring(3,6);
		var eDay=endDate.substring(0,2);
		eIntMonth = extractMonthInNumber(eMonth);
		endMonth=("00"+eIntMonth.toString()).slice(-2);
		var endDt=eYear+endMonth+eDay;
		endDt=parseInt(endDt);	
	}
		var sYear=startDate.substring(7,11);
		var sMonth=startDate.substring(3,6);
		var sDay=startDate.substring(0,2);
	
		var sIntMonth=extractMonthInNumber(sMonth);
		var startMonth=("00"+sIntMonth.toString()).slice(-2);
		var startDt=sYear+startMonth+sDay;
		startDt=parseInt(startDt);
	if (startDt > endDt)
	{
		return false;
	}
	else
	{
		return 	true;
	}
}
function extractMonthInNumber(month)
{
	var smonth=0;
	if(month=="JAN")	    smonth=1;
	else if(month=="FEB")	smonth=2;
	else if(month=="MAR")	smonth=3;
	else if(month=="APR")	smonth=4;
	else if(month=="MAY")	smonth=5;
	else if(month=="JUN")	smonth=6;
	else if(month=="JUL")	smonth=7;
	else if(month=="AUG")	smonth=8;
	else if(month=="SEP")	smonth=9;
	else if(month=="OCT")	smonth=10;
	else if(month=="NOV")	smonth=11;
	else if(month=="DEC")	smonth=12;
	return smonth;
}

function compareEqualDate(startDate,endDate)
{
	var sDate = "";
	var eDate = "";
	var array=new Array(3);
	
	if(endDate.toString().indexOf('-')==-1)
	{
		var eYear = endDate.getYear();
		var eMonth=endDate.getMonth()+1;
		var eDay=endDate.getDate();
		
		endYear=parseInt(eYear);
		endMonth=parseInt(eMonth);
		endDay=parseInt(eDay);
	}
	else
	{
		var eYear = endDate.substring(7,11);
		var eMonth=endDate.substring(3,6);
		var eDay=endDate.substring(0,2);
		
		eIntMonth = extractMonthInNumber(eMonth);
		endMonth=("00"+eIntMonth.toString()).slice(-2);
		var endDt=eYear+endMonth+eDay;
		endDt=parseInt(endDt);	
	}
	var sYear=startDate.substring(7,11);
	var sMonth=startDate.substring(3,6);
	var sDay=startDate.substring(0,2);
	
	
	var sIntMonth=extractMonthInNumber(sMonth);
	var startMonth=("00"+sIntMonth.toString()).slice(-2);
	var startDt=sYear+startMonth+sDay;
	startDt=parseInt(startDt);
	
	if (startDt == endDt)
	{
		return true;
	}
	else
	{
		return 	false;
	}
	/*if(startYear>endYear)
	{
		
		return false
	}
	else if(startYear == endYear && startMonth>endMonth)
	{
		return false;		
	}
	
	else if(startYear == endYear && startMonth==endMonth && startDay<=endDay)
	{
		return false;		
	}
	
	else
	{
		return true;
	}
	*/
}


/*function checkDate(startDate,endDate)
{
	var smallDate = "";
	var bigDate = "";

	var monthArray=new Array(11);
	monthArray[0]="JAN";
	monthArray[1]="FEB";
	monthArray[2]="MAR";
	monthArray[3]="APR";
	monthArray[4]="MAY";
	monthArray[5]="JUN";
	monthArray[6]="JUL";
	monthArray[7]="AUG";
	monthArray[8]="SEP";
	monthArray[9]="OCT";
	monthArray[10]="NOV";
	monthArray[11]="DEC";

	//For startDate
	smallDate = startDate.split("-").join("/");
	var sMon = smallDate.substring(3,6);

	for(i=0;i<12;i++)
	{
		if(sMon==monthArray[i])
		{
			var id=i+1;
		}
	}
	if(id < 10)
	{
		var sMonthId="0"+id;
	}
	else
		sMonthId = id;
	var sDate = new Date(smallDate.split(sMon).join(sMonthId));


	//For endDate
	if(endDate.toString().indexOf('-')==-1)
	{
		var eDate = endDate;
	}
	else
	{
		bigDate = endDate.split("-").join("/");
		var eMon = bigDate.substring(3,6);
		for(i=0;i<12;i++)
		{
			if(eMon==monthArray[i])
			{
				var id=i+1;
			}
		}
		if(id < 10)
		{
			var eMonthId="0"+id;
		}
		else
			eMonthId = id;
		var eDate = new Date(bigDate.split(eMon).join(eMonthId));
	}

	if(sDate>eDate)
	{
		//alert("From common.js Give Show Message>>date cant be later than sys date<<");
		return false;
	}
	else
	{
		return true;
	}
}*/

	/* Method for formatting date of any specified formats into the system date formats */
function dateFormatter(field)
{
	var abc = new Array(field.value.split("-"));
	for(i=0;i<abc.length;i++)
	{
		alert(abc[i]);
	}
}
function compareTime(startHH,startMM,startAMPM,endHH,endMM,endAMPM)
{
	var stHH;
	var enHH;
	if(startAMPM =='PM' && startHH!=12 )
	{
		stHH=parseInt(startHH, 10)+12;
		stHH=stHH+"";
	}
	else
	{
		stHH=startHH;
	}
	if(endAMPM=='PM' && endHH!=12)
	{
		enHH=parseInt(endHH, 10)+12;
		enHH=enHH+"";
	}
	else
	{
		enHH=endHH;
	}
	if(stHH.substring(0,1) =='0')
	{
		stHH=stHH.substring(1,stHH.length);
	}
	if(enHH.substring(0,1) =='0')
	{
		enHH=enHH.substring(1,enHH.length);
	}
	var startTime = stHH+startMM;
	var endTime1=enHH+endMM;
	if(parseInt(stHH, 10) > parseInt(enHH, 10) && (startAMPM != endAMPM ))
	{
		return false;
	}
	if(parseInt(startTime, 10) > parseInt(endTime1, 10) && (startAMPM == endAMPM))
	{
		return false;
	}
	else
	{
		return true;
	}
}


/* ########################## FUNCTION FOR CHECKING MANDATORY FIELDS ##################### */

	/* For a single field */
function checkRequiredField(field,label)
{	
	var ctrl = field;
	ctrl.value = trim(ctrl.value);
	if(ctrl.value.length==0)
	{
		showMsg(mandatory,label);
		ctrl.focus();

		return false;
	}
	else
	{
		return true;
	}
}
/* For different controls*/
function chkReqField(field,label,cntrl)
{

	var ctrl = field;
	ctrl.value = trim(ctrl.value);

	if(ctrl.value.length==0)
	{
		//for text-boxes
		if(cntrl=="txt")
		{
			showMsg(mandatory,label);
		}
		//for list-boxes
		if(cntrl=="list")
		{
			showMsg(noItem,label);
		}
		//for check-boxes
		if(cntrl=="chk")
		{
			alert("Include ShowMsg for : Plz select atleast one");
		}

		ctrl.focus();
		return false;
	}
	else
	{
		return true;
	}
}




	/* For a set of fields */
function checkRequiredFields(fields,labels)
{

	for(i=0;i<fields.length ;i++)
	{
		var ctrl =fields[i];

		if(trim(ctrl).length==0)
		{
			showMsg(mandatory,labels[i]);
			ctrl.focus();
			return false;
		}

	}
	return true;
}

/* ################################# FOR SHOWING MESSAGES ################################ */

	/* For a single element */
function showMsg(msg,field)
		{
			 var finalmsg="";
			 for(var i=0;i<msg.length;i++)
			 {
				 var chr = msg.charAt(i);
				 if(chr=="{")
				 {
					 i=i+2;
					finalmsg =finalmsg+field;
				 }
				 else
				 {
					  finalmsg = finalmsg+chr;
				 }

			 }
			 alert(finalmsg);
			 return;
		 }
		 /* For an array of elements */
function showArrMsg(msg,arr)
{
	var finalmsg="";
	for(var i=0;i<msg.length;i++)
	{
		var chr = msg.charAt(i);
		if(chr=="{")
		{
			var par;
			i++;
			par= msg.charAt(i);
			finalmsg =finalmsg+arr[parseInt(par)];
			i++;
		}
		else
		{
			finalmsg = finalmsg+chr;
		}
	}
	alert(finalmsg);
	return;
}

/*############################Methods Used in Ajax ############################################ */

var request;
function getXmlHttpRequest()
{
	if(window.XMLHttpRequest)
	{		
		request=new XMLHttpRequest();	 
	}
	else if (window.ActiveXObject) 
	{
		request = new ActiveXObject("Microsoft.XMLHTTP");
	}	
    else
	{
		alert("Your browser is not supporting XMLHttpRequest Object.");
	}
}


function fillCombo(responseXML,tagname) //responseXML is XML response object and tagname is the name of combobox and xmltagname tagname and conbobox name must be same
{
	var field = document.getElementById(tagname);
	var promt="";
	var promtVal="";
	var addBlankFirst=false;
	if(field.length>0)
	{	
		 addBlankFirst = true;
		 promt = field.options[0].text;
		 promtVal =field.options[0].value;
	}
	field.length=0;		
    var nodes = responseXML.getElementsByTagName(tagname); 
	var nVer = navigator.appVersion;
var nAgt = navigator.userAgent;
var browserName  = navigator.appName;
var fullVersion  = ''+parseFloat(navigator.appVersion); 
var majorVersion = parseInt(navigator.appVersion,10);
var nameOffset,verOffset,ix;

// In Opera 15+, the true version is after "OPR/" 
if ((verOffset=nAgt.indexOf("OPR/"))!=-1) {
 browserName = "Opera";
 fullVersion = nAgt.substring(verOffset+4);
}
// In older Opera, the true version is after "Opera" or after "Version"
else if ((verOffset=nAgt.indexOf("Opera"))!=-1) {
 browserName = "Opera";
 fullVersion = nAgt.substring(verOffset+6);
 if ((verOffset=nAgt.indexOf("Version"))!=-1) 
   fullVersion = nAgt.substring(verOffset+8);
}
// In MSIE, the true version is after "MSIE" in userAgent
else if ((verOffset=nAgt.indexOf("MSIE"))!=-1) {
 browserName = "Microsoft Internet Explorer";
 fullVersion = nAgt.substring(verOffset+5);
}
// In Chrome, the true version is after "Chrome" 
else if ((verOffset=nAgt.indexOf("Chrome"))!=-1) {
 browserName = "Chrome";
 fullVersion = nAgt.substring(verOffset+7);
}
// In Safari, the true version is after "Safari" or after "Version" 
else if ((verOffset=nAgt.indexOf("Safari"))!=-1) {
 browserName = "Safari";
 fullVersion = nAgt.substring(verOffset+7);
 if ((verOffset=nAgt.indexOf("Version"))!=-1) 
   fullVersion = nAgt.substring(verOffset+8);
}
// In Firefox, the true version is after "Firefox" 
else if ((verOffset=nAgt.indexOf("Firefox"))!=-1) {
 browserName = "Firefox";
 fullVersion = nAgt.substring(verOffset+8);
}
// In most other browsers, "name/version" is at the end of userAgent 
else if ( (nameOffset=nAgt.lastIndexOf(' ')+1) < 
          (verOffset=nAgt.lastIndexOf('/')) ) 
{
 browserName = nAgt.substring(nameOffset,verOffset);
 fullVersion = nAgt.substring(verOffset+1);
 if (browserName.toLowerCase()==browserName.toUpperCase()) {
  browserName = navigator.appName;
 }
}
// trim the fullVersion string at semicolon/space if present
if ((ix=fullVersion.indexOf(";"))!=-1)
   fullVersion=fullVersion.substring(0,ix);
if ((ix=fullVersion.indexOf(" "))!=-1)
   fullVersion=fullVersion.substring(0,ix);

majorVersion = parseInt(''+fullVersion,10);
if (isNaN(majorVersion)) {
 fullVersion  = ''+parseFloat(navigator.appVersion); 
 majorVersion = parseInt(navigator.appVersion,10);
}
//alert('Browser name  = '+browserName);
/*document.write(''
 +'Browser name  = '+browserName+'<br>'
 +'Full version  = '+fullVersion+'<br>'
 +'Major version = '+majorVersion+'<br>'
 +'navigator.appName = '+navigator.appName+'<br>'
 +'navigator.userAgent = '+navigator.userAgent+'<br>' 
)*/
//alert(nodes.length);
    for(var i = 0;i<nodes.length;i++)
    {
	    var newOpt = document.createElement("OPTION");
		/*if ((browserName == "Microsoft Internet Explorer" && parseInt(majorVersion) >= 9) || (browserName == "Netscape" && parseInt(majorVersion) >= 5))
		{
			newOpt.text = responseXML.documentElement.childNodes.item(i).attributes[0].value;
	   		newOpt.value = responseXML.documentElement.childNodes.item(i).attributes[1].value;
		}
		else
		{
			newOpt.text = responseXML.documentElement.childNodes.item(i).attributes[1].value;
			newOpt.value = responseXML.documentElement.childNodes.item(i).attributes[0].value;
		}
		newOpt.title = responseXML.documentElement.childNodes.item(i).attributes[1].value;
		*/
		newOpt.value = nodes[i].getAttribute('id');
		newOpt.text = nodes[i].getAttribute('name');
		newOpt.title = nodes[i].getAttribute('name');
		
		if(nodes[i].getAttribute('othValue'))
		{
			newOpt.setAttribute('othValue',nodes[i].getAttribute('othValue'));		
		}
		
	    field.options.add(newOpt,field.length);		
	}
	//if(promt!="" && promtVal=="")
	if((addBlankFirst == true)&&(promtVal==""))
	{
		 var newOpt = document.createElement("OPTION");
		 newOpt.text = promt;
		 newOpt.value="";
		 field.options.add(newOpt,0);
		 field.selectedIndex=0;
	}
}


/*########################################################################################*/
 function showAdvSearch()
 {
	 if(window.event.keyCode==11)
	 {
		 window.open("/"+webContext+"/jsps/advSearch.jsp","_blank", "height=150,width=350,scrollbars=yes,resizable=no,menubar=no,status=no,top=220,left=300,location=no" );
	 }
 }

 function changeCommand()
 {
	 alert("Hello");
	 //document.getElementById("command").value);
 }

 /**####################################Remove########################################*/
function removeWithClild(tableName,idColumn,idColumnValue,childTables,cacheobject)
{
	if(confirm("Are you sure want to delete this record ?"))
	{
		getXmlHttpRequest();
		var url="/"+webContext+"/jsps/remove.kspl?tableName="+encodeURIComponent(tableName);
		url = url+"&idColumn="+encodeURIComponent(idColumn);
		url = url+"&idColumnValue="+encodeURIComponent(idColumnValue);
		for(i=0;i<childTables.length;i++)
		{
			url = url+"&childTables="+encodeURIComponent(childTables[i]);
		}
		url = url+"&cacheObject="+encodeURIComponent(cacheobject);
		request.open("POST",url, true);
		request.onreadystatechange = removeCallback;
		request.send(null);
	}
	else
	{
		selectRow(null);
		return false;
	}
}
function remove(tableName,idColumn,idColumnValue,cacheobject)
{
	if(confirm("Are you sure want to delete this record ?"))
	{
		getXmlHttpRequest();
		var url="/"+webContext+"/jsps/remove.kspl?tableName="+encodeURIComponent(tableName);
		url = url+"&idColumn="+encodeURIComponent(idColumn);
		url = url+"&idColumnValue="+encodeURIComponent(idColumnValue);
		url = url+"&cacheObject="+encodeURIComponent(cacheobject);
		request.open("POST",url, true);
		request.onreadystatechange = removeCallback;
		request.send(null);
	}
	else
	{
		selectRow(null);
		return false;
	}
}
/*
Author Comment :
"newChildTables" and "newFkColName" are added whenever it is reqd. to delete from those Child Tables,
where there is a FK relationship, but with different column names.
Ex. : Parent Column is   : Batch_Subject_Id
	  Foreign Key Col is : Alt_Sub_BchSub_Id (But referring Batch_Subject_Id column
*/
function removeWithChild(tableName,idColumn,idColumnValue,childTables,cacheobject,newChildTables,newFkColName)
{
	if(confirm("Are you sure want to delete this record ?"))
	{
		getXmlHttpRequest();
		var url="/"+webContext+"/jsps/remove.kspl";
		url = url+"?tableName="+encodeURIComponent(tableName);
		url = url+"&idColumn="+encodeURIComponent(idColumn);
		url = url+"&idColumnValue="+encodeURIComponent(idColumnValue);
		for(i=0;i<childTables.length;i++)
		{
			url = url+"&childTables="+encodeURIComponent(childTables[i]);
		}
		for(k=0;k<newChildTables.length;k++)
		{
			url = url+"&newChildTables="+encodeURIComponent(newChildTables[k]);
		}
		url = url+"&newFkColName="+encodeURIComponent(newFkColName);
		url = url+"&cacheObject="+encodeURIComponent(cacheobject);
		request.open("POST",url, true);
		request.onreadystatechange = removeCallback;
		request.send(null);
	}
	else
	{
		return false;
	}
}
 
function removeCallback()
{
	if(request.readyState==4)
	{
		document.getElementById("message").innerHTML = request.responseText;
		afterRemove();
	}
}
var actionName;
function refresh_onDelete(actn)
{
	actionName=actn;
	setInterval(refreshPage,1500);
}
function refreshPage()
{
	window.location = actionName;
}

//#################################select row#########################
var prevRowid="";
function selectRow(rowid)
{
	if(prevRowid!="" &&  document.getElementById(prevRowid)!=null)
	{
		document.getElementById(prevRowid).className="labelcell";
	}
	if((rowid == null) || (rowid == "") || (document.getElementById(rowid) == null))
	{
		return;
	}
	else
	{
		prevRowid=rowid;
		document.getElementById(rowid).className="selectedRow";
	}
}

//###############################Hide Message################################3
/** This method is only applicable to Grades, since a grade can be '*A'. */
function checkFirstPositionForGrade(field,fieldname)
{

	for(i=0;i<field.value.length;i++)
	{
		var firstChar = field.value.charAt(i);
		if ( firstChar == '`'|| firstChar == '~'|| firstChar ==  '!'|| firstChar == '@'|| firstChar ==  '#'||firstChar == '$'||firstChar ==  '%'|| firstChar == '^'|| firstChar == '&' || firstChar == '('|| firstChar == ')'||firstChar == '-'|| firstChar == '+' || firstChar == '_' || firstChar =='{'|| firstChar =='}' || firstChar =='['|| firstChar ==']'|| firstChar == '<'|| firstChar =='>'|| firstChar =='?'|| firstChar == '/'  || firstChar ==';' || firstChar ==':'|| firstChar =='|'|| firstChar =='='|| firstChar =='\''|| firstChar =='&'|| firstChar ==','|| firstChar =='\"')
		{
				showMsg(firstPosition,fieldname);
				field.value="";
				field.focus() ;
				return false;
		}
		else
		{
			return true;
		}
	}
}

/** This method is to check the first method is not a special character. */
function checkFirstPosition(field,fieldname)
{

	for(i=0;i<field.value.length;i++)
	{
		var firstChar = field.value.charAt(i);
		if ( firstChar == '`'|| firstChar == '~'|| firstChar ==  '!'|| firstChar == '@'|| firstChar ==  '#'||firstChar == '$'||firstChar ==  '%'|| firstChar == '^'|| firstChar == '&' || firstChar == '*' || firstChar == '('|| firstChar == ')'||firstChar == '-'|| firstChar == '+' || firstChar == '_' || firstChar =='{'|| firstChar =='}' || firstChar =='['|| firstChar ==']'|| firstChar == '<'|| firstChar =='>'|| firstChar =='?'|| firstChar == '/'  || firstChar ==';' || firstChar ==':'|| firstChar =='|'|| firstChar =='='|| firstChar =='\''|| firstChar =='&'|| firstChar ==','|| firstChar =='\"')
		{
				showMsg(firstPosition,fieldname);
				field.value="";
				field.focus() ;
				return false;
		}
		else
		{
			return true;
		}
	}
}

function checkCharacter(field,fieldname)
{
	for(i=0;i<field.value.length;i++)
	{
		var firstChar = field.value.charAt(i);
		
		if (firstChar=='`'||firstChar=='~'||firstChar=='!'||firstChar=="'"||firstChar=='@'||firstChar== '#'||firstChar=='$'||firstChar=='.'||firstChar=='"'||firstChar==','||firstChar== '%'||firstChar=='^'||firstChar=='&'||firstChar=='*'||firstChar=='('||firstChar==')'||firstChar=='-'||firstChar=='+'||firstChar=='_'||firstChar =='{'||firstChar =='}'||firstChar =='['||firstChar ==']'||firstChar=='<'||firstChar =='>'||firstChar =='?'||firstChar=='/' ||firstChar ==';'||firstChar ==':'||firstChar =='|'||firstChar =='=')
		{
			alert ("Please enter a character for "+fieldname+".");
			field.value="";
			field.focus() ;
			return false;
		}
				
	}
}

function getWindowWidth()
{	if (parseInt(navigator.appVersion)>3)
		{
		 	if (navigator.appName=="Netscape")
		 	{
		  		return window.innerWidth;
		 	}
		 	if (navigator.appName.indexOf("Microsoft")!=-1)
	 	 	{
		  		return document.body.offsetWidth;
		 	}
		}
}
function getWindowHeight()
{
	if (parseInt(navigator.appVersion)>3)
		{
		 	if (navigator.appName=="Netscape")
		 	{
	 			return window.innerHeight;
		 	}
		 	if (navigator.appName.indexOf("Microsoft")!=-1)
	 	 	{
		  		return  document.body.offsetHeight;
		 	}
		}
}
function loadstafflist(ctrlId,ctrl,vehAllotParam,param1ForStfListFilter,param2ForStfListFilter,param3ForStfListFilter)
{
	var w=800;
	var h=600;
	if (parseInt(navigator.appVersion)>3)
	{
	 	if (navigator.appName=="Netscape")
	 	{
	  		w = window.innerWidth;
			h = window.innerHeight;
	 	}
	 	if (navigator.appName.indexOf("Microsoft")!=-1)
	 	{
	  		w = screen.width;
	  		h = screen.height-60;
	 	}
	}
	var popw = w*2/3;
	var popl = (w-popw)/2;
	var poph= (h-600)/2;
	if(popw<800)
	popw=800;
	var url="/"+webContext+"/jsps/HumanResource/loadStaffInfo.kspl?use=Y";
	url = url+"&ctrlId="+ctrlId;
	url = url+"&ctrl="+ctrl;
	url = url+"&vehAllotParam="+vehAllotParam;
	url = url+"&param1ForStfListFilter="+param1ForStfListFilter;
	url = url+"&param2ForStfListFilter="+param2ForStfListFilter;
	url = url+"&param3ForStfListFilter="+param3ForStfListFilter;
	window.open(url,"_blank","height=600,width="+popw+",scrollbars=yes,resizable=no,menubar=no,top="+poph+",left="+popl+"" );
}
function loadStudentlist(ctrlId,ctrl,callType,param1ForStdnListFilter,param2ForStdnListFilter,command,courseId,dscplnId,btchId)
{   
	var w=800;
	var h=600;
	if (parseInt(navigator.appVersion)>3)
	{
		if (navigator.appName=="Netscape")
		{
			w = window.innerWidth;
			h = window.innerHeight;
		}
		if (navigator.appName.indexOf("Microsoft")!=-1)
		{
			w = screen.width;
			h = screen.height-60;
		}
	}
	var popw = w*2/3;
	var popl = (w-popw)/2;
	var poph= (h-600)/2;
	if(popw<800)
	popw=800;
	var url="/"+webContext+"/jsps/StudentInformation/Student/loadStudentInformation.kspl?use=Y";
	url = url+"&ctrlId="+ctrlId;
	url = url+"&ctrl="+ctrl;
	url = url+"&listCallTypeFlag="+callType;
	url = url+"&param1ForStdnListFilter="+param1ForStdnListFilter;
	url = url+"&param2ForStdnListFilter="+param2ForStdnListFilter;
	url = url+"&command="+encodeURIComponent(command);
	url = url+"&course="+encodeURIComponent(courseId);
	url = url+"&cmbDiscipline="+encodeURIComponent(dscplnId);
	url = url+"&cmbBatch="+encodeURIComponent(btchId);
	//if((document.getElementById("hdnPageId") != null && document.getElementById("hdnPageId").value == "SI-REPORT-STDBONAFIDERPT") ||
	//	(document.getElementById("hdnPageId") != null && document.getElementById("hdnPageId").value == "SI-STDN-ABNORMALEXIT"))
	if((document.getElementById("hdnPageId") != null && document.getElementById("hdnPageId").value == "SI-STDN-ABNORMALEXIT"))
	{
		url = url+"&inactiveStdnForTC="+encodeURIComponent("Y");		
	}
	window.open(url,"_blank","height=600 width="+popw+",scrollbars=yes,resizable=no,menubar=no,top="+poph+",left="+popl+"");
}
//function loadBoarderlist(BoarderId,Name,Code,BoarderType,param1ForBodListFilter,param2ForBodListFilter,param3ForBodListFilter)
function loadBoarderCommonlist(ctrlId,ctrl,ctrl1,ctrl2,param1ForBodListFilter,param2ForBodListFilter,param3ForBodListFilter)
{
	var w=800;
	var h=600;
	if (parseInt(navigator.appVersion)>3)
	{
		if (navigator.appName=="Netscape")
		{
			w = window.innerWidth;
			h = window.innerHeight;
		}
		if (navigator.appName.indexOf("Microsoft")!=-1)
		{
			w = screen.width;
			h = screen.height-60;
		}
	}
	var popw = w*2/3;
	var popl = (w-popw)/2;
	var poph= (h-600)/2;
	if(popw<800)
	popw=800;
	var url="/"+webContext+"/jsps/HostelManagement/Transaction/boarderCommon.jsp?use=Y";
	url = url+"&ctrlId="+ctrlId;
	url = url+"&ctrl="+ctrl;
	url = url+"&ctrl1="+ctrl1;
	url = url+"&ctrl2="+ctrl2;
	url = url+"&param1ForBodListFilter="+param1ForBodListFilter;
	url = url+"&param2ForBodListFilter="+param2ForBodListFilter;
	url = url+"&param3ForBodListFilter="+param3ForBodListFilter;
	window.open(url,"_blank","height=600, width="+popw+" scrollbars=yes,resizable=no,menubar=no,top="+poph+",left="+popl+"" );
}
function loadCommonUserList()
{
	var w=800;
	var h=600;
	if (parseInt(navigator.appVersion)>3)
	{
		if (navigator.appName=="Netscape")
		{
			w = window.innerWidth;
			h = window.innerHeight;
		}
		if (navigator.appName.indexOf("Microsoft")!=-1)
		{
			w = screen.width;
			h = screen.height-60;
		}
	}
	var popw = w*2/3;
	var popl = (w-popw)/2;
	var poph= (h-600)/2;
	window.open("/"+webContext+"/jsps/components/showUserComp.kspl","_blank","height=600,width="+popw+",scrollbars=yes,resizable=no,menubar=no,top="+poph+",left="+popl+"" );
}

function loadAttachment()
{
	var w=800;
	var h=600;
	if (parseInt(navigator.appVersion)>3)
	{
		if (navigator.appName=="Netscape")
		{
			w = window.innerWidth;
			h = window.innerHeight;
		}
		if (navigator.appName.indexOf("Microsoft")!=-1)
		{
			w = screen.width;
			h = screen.height-60;
		}
	}
	var popw = w*2/3;
	var popl = (w-popw)/2;
	var poph= (h-600)/2;
	window.open("/"+webContext+"/jsps/components/attachFile.kspl","_blank","height=600 width="+popw+",scrollbars=yes,resizable=no,menubar=no,top="+poph+",left="+popl+"" );
}
function loadFilterearnDeductCodelist(ctrlId,ctrl,earn,deduct,ctrl2)
{
    var w=800;
	var h=600;
	if (parseInt(navigator.appVersion)>3)
	{
		if (navigator.appName=="Netscape")
		{
			w = window.innerWidth;
			h = window.innerHeight;
		}
		if (navigator.appName.indexOf("Microsoft")!=-1)
		{
			w = screen.width;
			h = screen.height-60;
		}
	}
	var popw = w*2/3;
	var popl = (w-popw)/2;
	var poph= (h-600)/2;
   	var url="/"+webContext+"/jsps/Payroll/Configuration/earnDeduct.jsp?use=Y";
 	url=url+"&ctrlId="+ctrlId;
	url=url+"&ctrl="+ctrl;
	url=url+"&ctrl2="+ctrl2;
	url=url+"&cmbEarnDeductSubType="+encodeURIComponent(earn);
	url=url+"&cmbEarnDeductSubTypeDed="+encodeURIComponent(deduct);
	window.open(url,"_blank","height=700, width="+popw+" scrollbars=yes,fullscreen=no,resizable=yes,menubar=no,top="+poph+",left="+popl+"" );
}

function loadEarnDeductDetailList()
{
	var w=800;
	var h=600;
	if (parseInt(navigator.appVersion)>3)
	{
		if (navigator.appName=="Netscape")
		{
			w = window.innerWidth;
			h = window.innerHeight;
		}
		if (navigator.appName.indexOf("Microsoft")!=-1)
		{
			w = screen.width;
			h = screen.height-60;
		}
	}
	var popw = w*2/3;
	var popl = (w-popw)/2;
	var poph= (h-600)/2;
	var url="/"+webContext+"/jsps/components/loadEarnDeductDetailList.kspl";
	/*url = url+"&cmbEarnDeductSubType="+encodeURIComponent(earn);
	url = url+"&cmbEarnDeductSubTypeDed="+encodeURIComponent(deduct);*/
	window.open(url,"_blank","height=700, width="+popw+" scrollbars=yes,fullscreen=no,resizable=yes,menubar=no,top="+poph+",left="+popl+"" );
	
}
function loadAccountHeadlistcomp()
{

	var w=800;
	var h=600;
	if (parseInt(navigator.appVersion)>3)
	{
		if (navigator.appName=="Netscape")
		{
			w = window.innerWidth;
			h = window.innerHeight;
		}
		if (navigator.appName.indexOf("Microsoft")!=-1)
		{
			w = screen.width;
			h = screen.height-60;
		}
	}
	var popw = w*2/3;
	var popl = (w-popw)/2;
	var poph= (h-600)/2;
    window.open("/"+webContext+"/jsps/components/loadAccountHeadList.kspl","_blank","height=600 width="+popw+",scrollbars=yes,resizable=no,menubar=no,top="+poph+",left="+popl+"" );
}

function loadMislistcomp()
{
	var w=800;
	var h=600;
	if (parseInt(navigator.appVersion)>3)
	{
		if (navigator.appName=="Netscape")
		{
			w = window.innerWidth;
			h = window.innerHeight;
		}
		if (navigator.appName.indexOf("Microsoft")!=-1)
		{
			w = screen.width;
			h = screen.height-60;
		}
	}
	var popw = w*2/3;
	var popl = (w-popw)/2;
	var poph= (h-600)/2;
	window.open("/"+webContext+"/jsps/components/loadMisList.kspl","_blank","height=600 width="+popw+" scrollbars=yes,resizable=no,menubar=no,top="+poph+",left="+popl+"" );
}

function loadTourAdvlist(ctrlId)
{
		var w=800;
		var h=600;
		if (parseInt(navigator.appVersion)>3)
		{
		 	if (navigator.appName=="Netscape")
		 	{
		  		w = window.innerWidth;
	 			h = window.innerHeight;
		 	}
		 	if (navigator.appName.indexOf("Microsoft")!=-1)
	 	 	{
		  		w = screen.width;
		  		h = screen.height-60;
		 	}
		}
		var popw = w*2/3;
		var popl = (w-popw)/2;
		var poph= (h-600)/2;
		var url="/"+webContext+"/jsps/FinancialAccounting/Tada/tourProgramDetails.jsp?use=Y";
		url = url+"&ctrlId="+ctrlId;
		window.open(url,"_blank","height=600, width="+popw+" scrollbars=yes,resizable=no,menubar=no,top="+poph+",left="+popl+"" );
}

function loadOltSublist(ctrlId,ctrl)
{   
	var w=800;
	var h=600;
	if (parseInt(navigator.appVersion)>3)
	{
		if (navigator.appName=="Netscape")
		{
			w = window.innerWidth;
			h = window.innerHeight;
		}
		if (navigator.appName.indexOf("Microsoft")!=-1)
		{
			w = screen.width;
			h = screen.height-60;
		}
	}
	var popw = w*2/3;
	var popl = (w-popw)/2;
	var poph= (h-600)/2;
	var url="/"+webContext+"/jsps/OnlineTest/Configuration/onlineSubject.jsp?use=Y";
	url = url+"&ctrlId="+ctrlId;
	url = url+"&ctrl="+ctrl;
	window.open(url,"_blank","height=600, width="+popw+" scrollbars=yes,resizable=no,menubar=no,top="+poph+",left="+popl+"" );
}
//country on change.
// countryId should be object Id
/*var targetId = ""
function country_onChange(sourseId, tagId, targetCmb)
{
	targetId = tagId;
	getXmlHttpRequest();
	var country = sourseId;
	var url="/"+webContext+"/jsps/Administration/Configuration/fillCountryOnChangeAction.kspl?";
	url = url + "&countryId="+encodeURIComponent(sourseId.value);
	url = url + "&targetId="+encodeURIComponent(tagId);
	request.open("GET",url, true);
	request.onreadystatechange = country_onChange_Callback;
	request.send(null);
}
function country_onChange_Callback()
{
	if(request.readyState==4)
	{
		fillCombo(request.responseXML,targetId);
		targetId = "";
		
	}
}

//state on change.
// stateId should be cmbStateId
var targetStId = "";
function state_onChange(sourseId, tagId, targetCmb)
{
	targetStId = tagId;
	getXmlHttpRequest();
	var state = sourseId;
	var url="/"+webContext+"/jsps/Administration/Configuration/fillStateOnChangeAction.kspl?";
	url = url + "&stateId="+encodeURIComponent(state.value);
	url = url + "&targetId="+encodeURIComponent(tagId);
	request.open("GET",url, true);
	request.onreadystatechange = state_onChange_Callback;
	request.send(null);
}
function state_onChange_Callback()
{
	if(request.readyState==4)
	{
		fillCombo(request.responseXML,targetStId);
		targetStId = "";
	}
}*/

function extractDate(selectedDate, fieldName)
{
	
	var array=new Array(3);
	var systemDate=new Date()
	var sysYear=systemDate.getYear()
	var sysMonth=systemDate.getMonth()+1
	var sysDay=systemDate.getDate()	
	var selectedYear=selectedDate.substring(7,11);
	var selectedMonth=selectedDate.substring(3,6)
	var selectedDay=selectedDate.substring(0,2)	
	var intMonth=extractMonthInNumber(selectedMonth); 
	var dobDate=new Date(selectedYear,intMonth,selectedDay)	
	var dobYear=dobDate.getYear()	
	var dobMonth=dobDate.getMonth()
	var dobDay=dobDate.getDate()	
	sysYear=parseInt(sysYear);
	sysMonth=parseInt(sysMonth);
	sysDay=parseInt(sysDay);
	dobYear=parseInt(dobYear);
	dobMonth=parseInt(dobMonth);
	dobDay=parseInt(dobDay);	
	if(dobYear<2000)
	{
		dobYear=dobYear+1900;	
	}	
	var differenceDays,differenceMonths,differenceYears

	if(sysDay<dobDay)
	{
		sysDay=sysDay+30;
		sysMonth=sysMonth-1;
	}	
	differenceDays=sysDay-dobDay;
	if(sysMonth<dobMonth)
	{
		sysMonth=sysMonth+12;
		sysYear=sysYear-1;
	}
	differenceMonths=sysMonth-dobMonth;
	differenceYears=sysYear-dobYear;	
	if(dobYear>sysYear)
	{
		alert(fieldName+" Must be less than Current Date.");
		array[0]=0;
		array[1]=0;
		array[2]=0;
		return array;
	}
	else if(dobYear == sysYear && dobMonth>sysMonth)
	{
			
		alert(fieldName+" Must be less than Current Date.");
		array[0]=0;
		array[1]=0;
		array[2]=0;
		return array;	
			
			
	}
	else if(dobYear == sysYear && dobMonth==sysMonth && dobDay>=sysDay)
	{			
		alert(fieldName+" Must be less than Current Date.");
		array[0]=0;
		array[1]=0;
		array[2]=0;
		return array;			
	}
	array[0]=differenceYears;
	array[1]=differenceMonths;
	array[2]=differenceDays;	
	return array;
}
//The bellow function is Already defined above
/*function extractMonthInNumber(month)
{
	var smonth=0;
	if(month=="JAN")	smonth=1;
	else if(month=="FEB")	smonth=2;
	else if(month=="MAR")	smonth=3;
	else if(month=="APR")	smonth=4;
	else if(month=="MAY")	smonth=5;
	else if(month=="JUN")	smonth=6;
	else if(month=="JUL")	smonth=7;
	else if(month=="AUG")	smonth=8;
	else if(month=="SEP")	smonth=9;
	else if(month=="OCT")	smonth=10;
	else if(month=="NOV")	smonth=11;
	else if(month=="DEC")	smonth=12;
	return smonth;	
}*/
function showTitles(ctrlId,ctrl)
{
	
	var w=800;
	var h=600;
	if (parseInt(navigator.appVersion)>3) 
	{
		if (navigator.appName=="Netscape") 
		{
			w = window.innerWidth;
			h = window.innerHeight;
		}
		if (navigator.appName.indexOf("Microsoft")!=-1) 
		{		  		
			w = screen.width;
			h = screen.height-60;
		}
	}
	var popw = w*2/3;
	var popl = (w-popw)/2;
	var poph= (h-600)/2;	
	var url="/"+webContext+"/jsps/LibraryManagement/Configuration/titles.jsp?use=Y";	
	url = url+"&ctrlId="+ctrlId;	
	url = url+"&ctrl="+ctrl;
	window.open(url,"_blank","height=600, width="+popw+" scrollbars=yes,resizable=no,menubar=no,top="+poph+",left="+popl+"" );

}
function showJournals(ctrlId,ctrl)
{	
	var w=800;
	var h=600;
	if (parseInt(navigator.appVersion)>3) 
	{
		if (navigator.appName=="Netscape") 
		{
			w = window.innerWidth;
			h = window.innerHeight;
		}
		if (navigator.appName.indexOf("Microsoft")!=-1) 
		{		  		
			w = screen.width;
			h = screen.height-60;
		}
	}
	var popw = w*2/3;
	var popl = (w-popw)/2;
	var poph= (h-600)/2;	
	var url="/"+webContext+"/jsps/LibraryManagement/Configuration/journal.jsp?use=Y";	
	url = url+"&ctrlId="+ctrlId;	
	url = url+"&ctrl="+ctrl;
	window.open(url,"_blank","height=600, width="+popw+" scrollbars=yes,resizable=no,menubar=no,top="+poph+",left="+popl+"" );
}
function loadDDCCodeList(ctrlId,ctrl,ctrlScreen)
{
	var w=800;
	var h=600;
	if (parseInt(navigator.appVersion)>3) 
	{
		if (navigator.appName=="Netscape") 
		{
			w = window.innerWidth;
			h = window.innerHeight;
		}
		if (navigator.appName.indexOf("Microsoft")!=-1) 
		{		  		
			w = screen.width;
			h = screen.height-60;
		}
	}
	var popw = w*2/3;
	var popl = (w-popw)/2;
	var poph= (h-600)/2;	
	var url="/"+webContext+"/jsps/LibraryManagement/Configuration/ddc.jsp?use=Y";	
	url=url+"&ctrlId="+ctrlId;	
	url=url+"&ctrl="+ctrl;
	url=url+"&ctrlScreen="+ctrlScreen;
	window.open(url,"_blank","height=600, width="+popw+" scrollbars=yes,resizable=no,menubar=no,top="+poph+",left="+popl+"" );
}
function checkCharacter(field,fieldname)
{
	for(i=0;i<field.value.length;i++)
	{
		var firstChar = field.value.charAt(i);
		
		if (firstChar=='`'||firstChar=='~'||firstChar=='!'||firstChar=="'"||firstChar=='@'||firstChar== '#'||firstChar=='$'||firstChar=='.'||firstChar=='"'||firstChar==','||firstChar== '%'||firstChar=='^'||firstChar=='&'||firstChar=='*'||firstChar=='('||firstChar==')'||firstChar=='-'||firstChar=='+'||firstChar=='_'||firstChar =='{'||firstChar =='}'||firstChar =='['||firstChar ==']'||firstChar=='<'||firstChar =='>'||firstChar =='?'||firstChar=='/' ||firstChar ==';'||firstChar ==':'||firstChar =='|'||firstChar =='=')
		{
			alert ("Please enter a character for "+fieldname+".");
			field.value="";
			field.focus() ;
			return false;
		}
				
	}
}
function loadTokenslist(ctrlId,ctrl,param)
{   
	var w=800;
	var h=600;
	if (parseInt(navigator.appVersion)>3)
	{
		if (navigator.appName=="Netscape")
		{
			w = window.innerWidth;
			h = window.innerHeight;
		}
		if (navigator.appName.indexOf("Microsoft")!=-1)
		{
			w = screen.width;
			h = screen.height-60;
		}
	}
	var popw = w*2/3;
	var popl = (w-popw)/2;
	var poph= (h-600)/2;
	var url="/"+webContext+"/jsps/FinancialAccounting/Transaction/tokens.jsp?use=Y";
	url = url+"&ctrlId="+ctrlId;
	url = url+"&ctrl="+ctrl;
	url = url+"&param="+param;
	window.open(url,"_blank","height=600, width="+popw+",scrollbars=yes,resizable=yes,menubar=no,top="+poph+",left="+popl+"" );
}


/* The following method will close the datepicker popup while clicking outside the calender */
function closeCal()
{
	if(document.getElementById("popCal").style.visibility!="hidden")
	{
		document.getElementById("popCal").style.visibility="hidden";
	}
}

function loadTenderTermsCondslist(ctrlId,ctrl)
{
	var w=800;
	var h=600;
	if (parseInt(navigator.appVersion)>3) 
	{
		if (navigator.appName=="Netscape")
		{
			w = window.innerWidth;
			h = window.innerHeight;
		}
		if (navigator.appName.indexOf("Microsoft")!=-1)
		{
			w = screen.width;
			h = screen.height-60;
		}
	}
	var popw = w*2/3;
	var popl = (w-popw)/2;
	var poph= (h-600)/2;
	var url="/"+webContext+"/jsps/Inventory/Configuration/paymentTerm.jsp?use=Y";	
	url=url+"&ctrlId="+ctrlId;	
	url=url+"&ctrl="+ctrl;
    url=url+"&cmdTermsCondsAppTo="+encodeURIComponent("COMMANDTERMSCONDS");
	window.open(url,"_blank","height=600, width="+popw+" scrollbars=yes,resizable=no,menubar=no,top="+poph+",left="+popl+"" );
}

//********************************** Added for Common report call by Priyaranjan on 25th Jan 2012 *********************//
var popReportWindow = "";
var rpType = "";

//Added By Sambit on 04-02-13
function showReportInFrame(vOperation)
{
	var vPathName = "";
	var vFullUrl = "/"+webContext+"/"+document.getElementById("hdnDbName").value+"/";
	if (document.getElementById("reportPathName"))
	{
		vPathName = document.getElementById("reportPathName").value;
	}
	
	//alert("Inside showReportInFrame="+vPathName);
	if(vOperation=="")
	{
		if (vPathName!="")
		{
			if (window.sessionStorage)
			{
  			window.sessionStorage.setItem("repDynPath", vPathName);
  			//alert("Inside showReportInFram sessionStoragee="+window.sessionStorage.getItem("repDynPath"));
			}
			
			var ext = vPathName.slice(vPathName.lastIndexOf(".")+1,vPathName.length)
			//alert("Inside showReportInFrame="+ext);
			if(ext.toUpperCase() == "XLS" || ext.toUpperCase() == "XLSX")
			{
				window.location.href = vFullUrl+vPathName;
			}
			else if((ext.toUpperCase() == "PDF") || (ext.toUpperCase() == "HTML"))
			{
				renderInFrame(vFullUrl+vPathName);
			}

  		}
  		
	}
	if (vOperation=="hyperlink")
	{
		document.getElementById("reportPathName").value = vPathName
		vPathName=window.sessionStorage.getItem("repDynPath");
		//alert("Inside showReportInFrame hyperlink="+vPathName);
		renderInFrame(vFullUrl+vPathName);
	}
					
}

//Added By Sambit on 04-02-13
function renderInFrame(vFullUrl)
{
	document.body.style.overflow="hidden";
	document.getElementById("reportHolderFrame").style.display="block";
	document.getElementById("reportHolderFrame").style.width=document.body.clientWidth;
	document.getElementById("reportHolderFrame").src=vFullUrl;
	//document.getElementById("lodingMsgDiv").style.display="none";
}

function loadReportInPopUp(url, query, reportType)
{
	//alert(query);
	if(reportType == "HTML")
		reportType = "H";
	else
		reportType = "P";
	rpType = reportType;
	//alert(document.body.innerHTML);
	document.getElementById("hdnEncTypeCode").value = randomString(9);
	var windowUrl = "";
	windowUrl = "/"+webContext+"/jsps/defaultPopUp.jsp?rT="+reportType;
	if(document.getElementById("hdnEncTypeCode") != null)
		windowUrl = windowUrl+"&hdnEncTypeCode="+encodeURI(document.getElementById("hdnEncTypeCode").value);
	popReportWindow = openPopUpWindow(windowUrl);
	if(popReportWindow==null)
	{
		alert("Please allow POPUP from your browser.");
	}
	popReportWindow.focus();
	getXmlHttpRequest();
	request.open("POST", url, true);	 
	request.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	request.onreadystatechange = loadReport_callBack;   
	request.send(query);
}

function openPopUpWindow(url)
{
	if(screen.availHeight)
	vHeight=screen.availHeight;
	else
	vHeight=screen.height;
	
	if(screen.availWidth)
	vWidth=screen.availWidth;
	else
	vWidth=screen.width;
	
	/*vHeight = (vHeight-(vHeight*0.175));
	vWidth = (vWidth-(vWidth*0.15));
	var top = (vHeight*0.03);
	var left = (vWidth*0.07);*/
	vHeight = vHeight-50;
	vWidth = vWidth-20;
	var vTop = 4;
	var vLeft = 4;

	return window.open(url,"_blank","height="+vHeight+",width="+vWidth+",scrollbars=yes,resizable=no,menubar=no,top="+vTop+",left="+vLeft+"" );
}
function loadReport_callBack()
{
	if(request.readyState==4)
	{
		//popReportWindow.document.body.innerHTML=request.responseText;
		var child_url = check_URL(popReportWindow);
		var patt = new RegExp("unauthorized");
		if(patt.test(child_url))
		{
			return false;
		}
		else
		{
			/*if(request.status == 200)
			{*/
				//popReportWindow.document.write(request.responseText);
				if(popReportWindow && !popReportWindow.closed)
				{
					
					var fileName="";
					var ext="";
					
					popReportWindow.document.open();
					popReportWindow.document.write(request.responseText);
					popReportWindow.document.close();
					//alert(request.responseText);
					/*alert(popReportWindow.document.getElementById("reportPathName").value);
					if(popReportWindow.document.getElementById("reportPathName"))
					{
						fileName = popReportWindow.document.getElementById("reportPathName").value;
					}
					if (fileName!="")
					{
						ext = fileName.slice(fileName.lastIndexOf(".")+1,fileName.length)
					}
					//alert(fileName);
					//alert(ext);
					var url = "/"+webContext+"/reports/"+fileName;
					
					if(ext.toUpperCase() == "XLS")
					{
						popReportWindow.location.href = url;
					}
					else if((rpType == "P") || (ext.toUpperCase() == "HTML"))
					{
						alert(popReportWindow);
						alert(fileName);
						showReportInFrame(popReportWindow,fileName);
					}*/
					
				}
				else
				{
					alert("The popup has been blocked by your browser.\nPlease allow the popups from this host and try again.");
				}
			/*}
			else
			{
				var path = "/"+webContext+"/reports/UserGeneratedReports/defaultReportError.html";
				popReportWindow.location.href = path;
			}*/
		}
	}
}
function randomString(length) {
    var chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz'.split('');
    
    if (! length) {
        length = Math.floor(Math.random() * chars.length);
    }
    
    var str = '';
    for (var i = 0; i < length; i++) {
        str += chars[Math.floor(Math.random() * chars.length)];
    }
	var genrtdStr = str+new Date().getTime();
    return genrtdStr;
}
function check_URL(childWindow)
{
	childWindow.focus();
	var child_url = null;
	if(childWindow.location)
		child_url = childWindow.location;
	else
		child_url = childWindow.document.location;
	return child_url;
}


function loadTenderSupplierlist(ctrlId,ctrl,ctrlFor)
{
	var w=800;
	var h=600;
	if (parseInt(navigator.appVersion)>3) 
	{
		if (navigator.appName=="Netscape")
		{
			w = window.innerWidth;
			h = window.innerHeight;
		}
		if (navigator.appName.indexOf("Microsoft")!=-1)
		{
			w = screen.width;
			h = screen.height-60;
		}
	}
	var popw = w*2/3;
	var popl = (w-popw)/2;
	var poph= (h-600)/2;
	var url="/"+webContext+"/jsps/FinancialAccounting/Configuration/loadFilterPartyDetail.kspl?use=Y";	
	url=url+"&ctrlId="+ctrlId;	
	url=url+"&ctrl="+ctrl;
    url=url+"&cmdSupplierAppTo="+encodeURIComponent("COMMANDSUPPLIER");
	url=url+"&ctrlFor="+ctrlFor;
	window.open(url,"_blank","height=600, width="+popw+" scrollbars=yes,resizable=no,menubar=no,top="+poph+",left="+popl+"" );
}

function loadTenderList(ctrlId,ctrl,ctrlFor)
{
	var w=800;
	var h=600;
	if (parseInt(navigator.appVersion)>3) 
	{
		if (navigator.appName=="Netscape")
		{
			w = window.innerWidth;
			h = window.innerHeight;
		}
		if (navigator.appName.indexOf("Microsoft")!=-1)
		{
			w = screen.width;
			h = screen.height-60;
		}
	}
	var popw = w*2/3;
	var popl = (w-popw)/2;
	var poph= (h-600)/2;
	var url="/"+webContext+"/jsps/Inventory/Transaction/loadTender.kspl?use=Y";	
	url=url+"&ctrlId="+ctrlId;	
	url=url+"&ctrl="+ctrl;
	url=url+"&ctrlFor="+ctrlFor;
	window.open(url,"_blank","height=600, width="+popw+" scrollbars=yes,resizable=no,menubar=no,top="+poph+",left="+popl+"" );
}

function loadPurposeList(ctrlId,ctrl,ctrlFor)
{
	var w=800;
	var h=600;
	if (parseInt(navigator.appVersion)>3) 
	{
		if (navigator.appName=="Netscape")
		{
			w = window.innerWidth;
			h = window.innerHeight;
		}
		if (navigator.appName.indexOf("Microsoft")!=-1)
		{
			w = screen.width;
			h = screen.height-60;
		}
	}
	var popw = w*2/3;
	var popl = (w-popw)/2;
	var poph= (h-600)/2;
	var url="/"+webContext+"/jsps/Inventory/Configuration/purpose.jsp?use=Y";	
	url=url+"&ctrlId="+ctrlId;	
	url=url+"&ctrl="+ctrl;
	url=url+"&ctrlFor="+ctrlFor;
	window.open(url,"_blank","height=600, width="+popw+" scrollbars=yes,resizable=no,menubar=no,top="+poph+",left="+popl+"" );
}

function loadTechCriteriaList(ctrlId,ctrl)
{
	var w=800;
	var h=600;
	if (parseInt(navigator.appVersion)>3) 
	{
		if (navigator.appName=="Netscape")
		{
			w = window.innerWidth;
			h = window.innerHeight;
		}
		if (navigator.appName.indexOf("Microsoft")!=-1)
		{
			w = screen.width;
			h = screen.height-60;
		}
	}
	var popw = w*2/3;
	var popl = (w-popw)/2;
	var poph= (h-600)/2;
	var url="/"+webContext+"/jsps/Inventory/Configuration/technicalCriteria.jsp?use=Y";	
	url=url+"&ctrlId="+ctrlId;	
	url=url+"&ctrl="+ctrl;
	window.open(url,"_blank","height=600, width="+popw+" scrollbars=yes,resizable=no,menubar=no,top="+poph+",left="+popl+"" );
}

// Following function is used to view Leave Rules (In New Leave Module)
// Created by : Tapan
function loadLeaveRules(leaveMstId,pageid)
{
	var url="/"+webContext+"/jsps/HumanResource/LeaveTrans/loadLeaveRules.kspl?hdnLeaveMstId="+leaveMstId;
	url=url+"&hdnPageId="+pageid;
	//window.open(url,"_blank","height=400,width=950,scrollbars=yes,resizable=no,menubar=no,top=10,left=150");
	loadReportInPopUp(url, "", "html");
}

/*OLD Value is the value need to be retained, ctrl is just the contrl object. Prevents combo field to change.
SAMPLE USAGE: onChange="preventDropdownChange('<%=gridRecArray[2]%>', this);" Author: Chitta 3rd-May-2012"*/
function preventDropdownChange(oldVal, ctrl)
{
	if((oldVal != ctrl.value) && (oldVal != ""))
	{
		ctrl.value = oldVal;
	}
}


/*Java Script For Drilldown Reports By Sambit Kar*/
/*Start*/
function FormatResponseHtml(rptPath,rptWidth,rspText,padLevel)
{
var rptName=rptPath.substring(rptPath.lastIndexOf("/")+1,rptPath.lastIndexOf("."));
var userId=rptPath.substring(rptPath.indexOf("UserGeneratedReports/")+21,rptPath.indexOf("/",rptPath.indexOf("UserGeneratedReports/")+21));
rspText=rspText.replace(/<td width=\"50%\">&nbsp;<\/td>/g,"<td width='0%'></td>").replace(new RegExp(rptName+'.html_files', 'g'),"/"+webContext+"/reports/UserGeneratedReports/"+userId+"/"+rptName+'.html_files');
if (padColWidth>0)
{
	if (padLevel>0)
	{
	rspText=rspText.replace(new RegExp('width: '+rptWidth, 'g'),'width: '+(rptWidth-(rptPadwidth*padLevel)));
	rspText=rspText.replace(new RegExp('width: '+padColWidth, 'g'),'width: '+(padColWidth-(rptPadwidth*padLevel)));
	}
	//alert(rspText);
}

return rspText;
}
var fontColor="";
var changeColor="";
var rptWidth="";
var rptColSpan="";
var mainReportDivNo=0;
var reportContextPath="";
var childNodeSeed=1;
var childNodeIncr=1;
var rptPadwidth=0;
var padColWidth=0;
var expandFlag=0;
function showMainReport(param)
{
	//alert(param.rptPath);
	if (navigator.appName=="Netscape")
	{
		childNodeSeed=3;
		childNodeIncr=2;
	}
	if(param.hasOwnProperty('rptPadwidth'))
	{
		rptPadwidth= param.rptPadwidth;
	}
	else
	{
		rptPadwidth=0;
	}
	if(param.hasOwnProperty('padColWidth'))
	{
		padColWidth= param.padColWidth;
	}
	else
	{
		padColWidth=0;
	}
	fontColor=param.fontColor;
	changeColor=param.changeColor;
	rptWidth=param.rptWidth;
	rptColSpan=param.colSpan;
	reportContextPath=param.rptPath.slice(0,param.rptPath.indexOf(","));
	param.rptPath=param.rptPath.slice(param.rptPath.indexOf(",")+1,param.rptPath.length);
	
	renderReport(param);

}
function renderReport(param)
{
	var rptPath="";
	var divId="";
	if (param.rptPath.indexOf(",")>-1)
	{
		rptPath=reportContextPath+param.rptPath.slice(0,param.rptPath.indexOf(","));
		param.rptPath=param.rptPath.slice(param.rptPath.indexOf(",")+1,param.rptPath.length);
		divId=param.divId+mainReportDivNo;
		mainReportDivNo++;
	}
	else
	{
		rptPath=reportContextPath+param.rptPath;
		param.rptPath="";
		divId=param.divId+mainReportDivNo;
	}

	//var rptName=rptPath.substring(rptPath.lastIndexOf("/")+1,rptPath.lastIndexOf("."));
	//alert(rptName);
   document.getElementById(divId).innerHTML ="<center>Please Wait.... Loading Report...</center>";
   getXmlHttpRequest();
   request.open("GET",rptPath, true);	 
   request.onreadystatechange = function showMainReportOnChangeCallback()
   {
		if(request.readyState==4)
		{	
			var rspText=FormatResponseHtml(rptPath,rptWidth,request.responseText,0);
			//alert(rspText);
			document.getElementById(divId).innerHTML = rspText;
			AssignIdToAnchorTag(1);
			if(param.rptPath.length>0)
			{
				renderReport(param);
			}
		}
	};   
   request.send(null);	
}
function AssignIdToAnchorTag(padLevel)
{
  var linkelement=document.getElementsByTagName("a");
  var childNodesno;
  for (var i=1; i<linkelement.length;i++)
  {
  	var param=linkelement[i].href.substring(linkelement[i].href.lastIndexOf("{"), linkelement[i].href.lastIndexOf("}")+1);
	//alert(linkelement[i].href)
	if (param!="")
	{
	var paramObj=eval('(' + param + ')');
	var vFontColor=fontColor;
	var vChangeColor=changeColor;
 	//alert(paramObj.ID);
	 	if(!(linkelement[i].id))
	 	{
			linkelement[i].id='A-'+paramObj.ID;
			linkelement[i].setAttribute('padLevel', padLevel);
	
			//assign datarow font color to vFontColor if found the property
			if(paramObj.hasOwnProperty('fontColor'))
			{
			vFontColor=paramObj.fontColor;
			}
			
			if(paramObj.hasOwnProperty('changeColor'))
			{
			vChangeColor=paramObj.changeColor;
			}
			
			if(!(linkelement[i].getAttribute('fntColorCngFlg')))
			{
				linkelement[i].setAttribute('fntColorCngFlg', '0');
			}
			//set the font color and change color of the data row
			linkelement[i].setAttribute('fntColor', vFontColor);
			linkelement[i].setAttribute('cngColor', vChangeColor);
				if(linkelement[i].getAttribute('fntColorCngFlg')=='0')
				{
					linkelement[i].style.color = vFontColor;
					childNodesno=childNodeSeed;
			
					for(var j=1;j<rptColSpan;j++)
					{
					childNodesno=eval(childNodesno+childNodeIncr);
					linkelement[i].parentNode.parentNode.parentNode.childNodes[childNodesno].childNodes[0].childNodes[0].style.color=vFontColor;		
					}
				}
			

			// Color change event for mouse Start
			//////////////////////////////////////////////////////////////////////
			linkelement[i].onmouseover = function(){
				if(this.getAttribute('fntColorCngFlg')=='0')
				{
					this.style.color = this.getAttribute('cngColor');
					childNodesno=childNodeSeed;
					//alert(childNodesno);
					for(var i=1;i<rptColSpan;i++)
					{
						childNodesno=eval(childNodesno+childNodeIncr);
						this.parentNode.parentNode.parentNode.childNodes[childNodesno].childNodes[0].childNodes[0].style.color = this.getAttribute('cngColor');
						//alert(childNodesno);
					}	
					this.setAttribute('fntColorCngFlg', '1');
				} 
			};
			
					
			
			linkelement[i].onmouseout = function(){
				if(this.getAttribute('fntColorCngFlg')=='1')
				{
					this.style.color = this.getAttribute('fntColor');
					childNodesno=childNodeSeed;
					for(var i=1;i<rptColSpan;i++)
					{
						childNodesno=eval(childNodesno+childNodeIncr);
						this.parentNode.parentNode.parentNode.childNodes[childNodesno].childNodes[0].childNodes[0].style.color = this.getAttribute('fntColor');			
					}	
					this.setAttribute('fntColorCngFlg', '0');
				} 
			};
			//////////////////////////////////////////////////////////////////////
				
			
			
			// Color change event for key
			//////////////////////////////////////////////////////////////////////
			linkelement[i].onfocus  = function(){
				if(this.getAttribute('fntColorCngFlg')=='0')
				{
					this.style.color = this.getAttribute('cngColor');
					childNodesno=childNodeSeed;
					//alert(childNodesno);
					for(var i=1;i<rptColSpan;i++)
					{
						childNodesno=eval(childNodesno+childNodeIncr);
						this.parentNode.parentNode.parentNode.childNodes[childNodesno].childNodes[0].childNodes[0].style.color = this.getAttribute('cngColor');
						//alert(childNodesno);
		}
					this.setAttribute('fntColorCngFlg', '1');
	}
			};
			
					
			
			linkelement[i].onblur  = function(){
				if(this.getAttribute('fntColorCngFlg')=='1')
				{
					this.style.color = this.getAttribute('fntColor');
					childNodesno=childNodeSeed;
					for(var i=1;i<rptColSpan;i++)
					{
						childNodesno=eval(childNodesno+childNodeIncr);
						this.parentNode.parentNode.parentNode.childNodes[childNodesno].childNodes[0].childNodes[0].style.color = this.getAttribute('fntColor');			
  }
					this.setAttribute('fntColorCngFlg', '0');
}
			};
			//////////////////////////////////////////////////////////////////////
			
		}
	}
  }
}
function DoDrilldown(param)
{
	
	var childNodesno;
	var dataAreaId='td-'+param.uniqueId;
	var anchorId='A-'+param.uniqueId;
	if (document.getElementById(dataAreaId))
	{
		var data = document.getElementById(dataAreaId).innerHTML;
	}
	else
	{
		var data="";
	}
	if (data=="")
	{
		if(param.hasOwnProperty('rptWidth'))
		{
			rptWidth=param.rptWidth;
		}
		
		if (!(document.getElementById(dataAreaId)))
		{
			var newtr=document.createElement("tr");
			var tdtext = document.createTextNode("");
			
			var td_left_mrgn=document.createElement("td");
			td_left_mrgn.appendChild(tdtext);
			//td_left_mrgn.style.border="1px solid blue";
			//td_left_mrgn.innerHTML="<img  src='/"+webContext+"/images/icons/line.gif' />";
			//td_left_mrgn.style.width=rptPadwidth+'px';
			//td_left_mrgn.style.textAlign="center";
			newtr.appendChild(td_left_mrgn);		
	
			var td_data=document.createElement("td");
			td_data.appendChild(tdtext);
			td_data.id=dataAreaId;
			td_data.colSpan=rptColSpan;
			td_data.style.height="10px";
			//td_data.style.border="1px solid blue";
			newtr.appendChild(td_data);		
	//		newtr.style.border="1px solid black";
			document.getElementById(anchorId).parentNode.parentNode.parentNode.parentNode.insertBefore(newtr, document.getElementById(anchorId).parentNode.parentNode.parentNode.nextSibling);
			document.getElementById(dataAreaId).style.textAlign="right";
		}


			document.getElementById(anchorId).style.color=document.getElementById(anchorId).getAttribute('cngColor');
			document.getElementById(anchorId).setAttribute('fntColorCngFlg', '2');
			var padLevel = document.getElementById(anchorId).getAttribute('padLevel')
			//alert(padLevel);
			
			childNodesno=childNodeSeed;
			for(var i=1;i<rptColSpan;i++)
			{
				childNodesno=eval(childNodesno+childNodeIncr);
				//alert(childNodesno);
				document.getElementById(anchorId).parentNode.parentNode.parentNode.childNodes[childNodesno].childNodes[0].childNodes[0].style.color=document.getElementById(anchorId).getAttribute('cngColor');
				
			}

		document.getElementById('td-'+param.uniqueId).innerHTML ="<center>Loading Detail...</center>";

		
		request.open("GET",param.actionPath, true);	 
		request.onreadystatechange = function OnChangeCallback()
				{
					if(request.readyState==4)
					{	
					 document.getElementById(dataAreaId).style.height="10px";
					 document.getElementById('td-'+param.uniqueId).innerHTML = request.responseText;
					 ShowReport(param.uniqueId,document.getElementById('hdnReportPath').value,padLevel);
					 //alert(rspText);
					}
				};   
		request.send(null);	

		return true;
	}
	else
	{
		document.getElementById(dataAreaId).innerHTML="";
		document.getElementById(dataAreaId).style.height="0px";
		document.getElementById(anchorId).style.color=document.getElementById(anchorId).getAttribute('fntColor');		
		document.getElementById(anchorId).setAttribute('fntColorCngFlg', '1');
		childNodesno=childNodeSeed;
		for(var i=1;i<rptColSpan;i++)
		{
			childNodesno=eval(childNodesno+childNodeIncr);
			//alert(childNodesno);
			document.getElementById(anchorId).parentNode.parentNode.parentNode.childNodes[childNodesno].childNodes[0].childNodes[0].style.color=document.getElementById(anchorId).getAttribute('fntColor');		
		}
		 if (expandFlag==1)
		 {
			 expandAll({autoExpand:'Y'});
		 }

		return false;
	}
	//alert(data);
}

function ShowReport(pId,reportPath,padLevel)
{
//alert(reportPath);
		document.getElementById('td-'+pId).innerHTML ="<center>Loading Detail...</center>";
		//var rptName=reportPath.substring(reportPath.lastIndexOf("/")+1,reportPath.lastIndexOf("."));
		request.open("GET",reportPath, true);	 
		request.onreadystatechange = function OnChangeCallback()
				{
					if(request.readyState==4)
					{	
					//alert(padLevel);
					 var rspText=FormatResponseHtml(reportPath,rptWidth,request.responseText,padLevel);
					 document.getElementById('td-'+pId).innerHTML = rspText;
					 //alert(rspText);
					 padLevel = parseInt(padLevel)+1;
					 AssignIdToAnchorTag(padLevel);
					 if (expandFlag==1)
					 {
						 expandAll({autoExpand:'Y'});
					}
					}
				};   
		request.send(null);	
	
}
var expandParamObj;
function expandAll(param)
{
  	var expandNum=0;
  	var linkelement=document.getElementsByTagName("a");
  	var url="";
  	var result = true;
  	var paramProp;
  	var paramValue;
 	var expandRestoreFlg=0;

	
	expandFlag=1;
	
	if(document.getElementById("statusDiv"))
	{
		document.getElementById("statusDiv").style.height=(document.body.scrollHeight-10)+"px";
		window.scrollTo(0, document.body.scrollHeight);
	}

	
	if (!(param.hasOwnProperty('autoExpand')))
	{
		expandParamObj=param;
	 	var statusDiv=document.createElement("div");
		statusDiv.id="statusDiv";
 		statusDiv.style.display="block";
		statusDiv.style.position="absolute";
		statusDiv.style.left="2%";
		statusDiv.style.top="5px";
		statusDiv.style.width="96%";
		statusDiv.style.height=document.body.scrollHeight-5;
		statusDiv.style.background="silver";
		statusDiv.zIndex="100";
		if (navigator.appName=="Netscape")
		{
			statusDiv.style.opacity=0.2;	
		}
		else
		{
	 		statusDiv.style.filter="alpha(opacity = 20)";			
		}
		document.body.appendChild(statusDiv);

	}
	//alert(document.getElementById("statusDiv").position);
	
	
  	if (document.getElementById(expandParamObj.expandLink).getAttribute('ExpandRestoreFlg'))
  	{
	  expandRestoreFlg=document.getElementById(expandParamObj.expandLink).getAttribute('ExpandRestoreFlg');
  	}

  	for (var i=1; i<linkelement.length;i++)
  	{
  		endExpand=0;
		var paramLink=linkelement[i].href.substring(linkelement[i].href.lastIndexOf("{"), linkelement[i].href.lastIndexOf("}")+1);

		if (paramLink!="")
		{
			var paramObj=eval('(' + paramLink + ')');
			if (expandParamObj.hasOwnProperty('expandRule'))
			{
				result = false;
				
				//for = condition
				if(expandParamObj.expandRule.indexOf('=')>-1)
				{
					paramProp=expandParamObj.expandRule.slice(0,expandParamObj.expandRule.indexOf('='));
					paramValue=expandParamObj.expandRule.slice(expandParamObj.expandRule.indexOf('=')+1,expandParamObj.expandRule.length);
					result = (paramObj[paramProp]==paramValue);
				}

				//for != condition
				if(expandParamObj.expandRule.indexOf('!=')>-1)
				{
					paramProp=expandParamObj.expandRule.slice(0,expandParamObj.expandRule.indexOf('!='));
					paramValue=expandParamObj.expandRule.slice(expandParamObj.expandRule.indexOf('!=')+1,expandParamObj.expandRule.length);
					result = (paramObj[paramProp]==paramValue);
				}

				//for > condition
				if(expandParamObj.expandRule.indexOf('>')>-1)
				{
					paramProp=expandParamObj.expandRule.slice(0,expandParamObj.expandRule.indexOf('>'));
					paramValue=expandParamObj.expandRule.slice(expandParamObj.expandRule.indexOf('>')+1,expandParamObj.expandRule.length);
					result = (paramObj[paramProp]==paramValue);
				}

				//for < condition
				if(expandParamObj.expandRule.indexOf('<')>-1)
				{
					paramProp=expandParamObj.expandRule.slice(0,expandParamObj.expandRule.indexOf('<'));
					paramValue=expandParamObj.expandRule.slice(expandParamObj.expandRule.indexOf('<')+1,expandParamObj.expandRule.length);
					result = (paramObj[paramProp]==paramValue);
				}
				
				
			}

			if ((linkelement[i].getAttribute('fntColorCngFlg')==expandRestoreFlg) && (result))
			{
				for (prop in expandParamObj)
				{
					if(prop.indexOf('expand')<0)
					{
						if(prop!='actionPath')
						{
							url=url+prop+"="+paramObj[expandParamObj[prop]]+"&";
						}	
						else
						{
							url="/"+webContext+expandParamObj.actionPath+"?";
						}
					}
				}
				
				url=url+"randId="+Math.random()
				DoDrilldown({'actionPath':url,'uniqueId':paramObj.ID});
				expandNum=1;
				i=eval(linkelement.length+1);
			}
		}
  	}
  	
  	if(expandNum==0)
  	{
	  document.body.removeChild(document.getElementById("statusDiv"));	
	  window.scrollTo(0,0);
	  expandFlag=0;
	  if(document.getElementById(expandParamObj.expandLink).getAttribute('ExpandRestoreFlg')=='2')
	  {
		  document.getElementById(expandParamObj.expandLink).innerHTML = "Expand All";
		  document.getElementById(expandParamObj.expandLink).setAttribute('ExpandRestoreFlg', '0');
  	  }
  	  else
  	  {
		  document.getElementById(expandParamObj.expandLink).innerHTML = "Restore All";
		  document.getElementById(expandParamObj.expandLink).setAttribute('ExpandRestoreFlg', '2');
  	  }
  	}
  
}
/*End*/
/*Java Script For Drilldown Reports*/
/*Get value from multiple Radio / Check box by Sambit*/
function getSelectBoxCheckedValue(elementName)
{
	
   var selectBoxObj = document.getElementsByName(elementName);
 	
   for(var i = 0; i < selectBoxObj.length; i++)
   {
      if(selectBoxObj[i].checked)
      {
         return selectBoxObj[i].value;
      }
   }
 
   return '';
}
/*End Get Value*/
//************************************************

function loadPartyListForPO(ctrlId,ctrl,ctrlId2,ctrlFor,ctrlId3,ctrlVal)
{	

	var w=800;
	var h=600;
	if (parseInt(navigator.appVersion)>3) 
	{
		if (navigator.appName=="Netscape") 
		{
			w = window.innerWidth;
			h = window.innerHeight;
		}
		if (navigator.appName.indexOf("Microsoft")!=-1) 
		{		  		
			w = screen.width;
			h = screen.height-60;
		}
	}
	var popw = w*2/3;
	var popl = (w-popw)/2;
	var poph= (h-600)/2;
	var url="/"+webContext+"/jsps/FinancialAccounting/Configuration/loadFilterPartyDetail.kspl?use=Y";
	url=url+"&ctrlId="+ctrlId;
	url=url+"&ctrl="+ctrl;
	url=url+"&ctrlId2="+ctrlId2;
	url=url+"&ctrlId3="+ctrlId3;
	url=url+"&ctrlVal="+ctrlVal;
	url=url+"&ctrlFor="+ctrlFor;
	url=url+"&isUseForPOScreen="+encodeURIComponent("POSCREEN");
	window.open(url,"_blank","height=600, width="+popw+",scrollbars=yes,resizable=no,menubar=no,top="+poph+",left="+popl+"" );
}
//******************************************************

function loadStfJob(ctrlId,ctrl)
{
	var w=800;
	var h=600;
	if (parseInt(navigator.appVersion)>3) 
	{
		if (navigator.appName=="Netscape") 
		{
			w = window.innerWidth;
			h = window.innerHeight;
		}
		if (navigator.appName.indexOf("Microsoft")!=-1) 
		{		  		
			w = screen.width;
			h = screen.height-60;
		}
	}
	var popw = w*2/3;
	var popl = (w-popw)/2;
	var poph= (h-600)/2;
	var url="/"+webContext+"/jsps/HumanResource/Recruitment/loadStfJobId.kspl?use=Y";	
	url=url+"&ctrlId="+ctrlId;
	url=url+"&ctrl="+ctrl;		
	window.open(url,"_blank","height=600 width="+popw+" scrollbars=yes,resizable=no,menubar=no,top="+poph+",left="+popl+"" );
}
//***************************************************

function loadApplicantNo(ctrlId,ctrl)
{
	var w=800;
	var h=600;
	if (parseInt(navigator.appVersion)>3) 
	{
		if (navigator.appName=="Netscape") 
		{
			w = window.innerWidth;
			h = window.innerHeight;
		}
		if (navigator.appName.indexOf("Microsoft")!=-1) 
		{		  		
			w = screen.width;
			h = screen.height-60;
		}
	}
	var popw = w*2/3;
	var popl = (w-popw)/2;
	var poph= (h-600)/2;
	var url="/"+webContext+"/jsps/HumanResource/Recruitment/loadStfAppForm.kspl?use=Y";	
	url=url+"&ctrlId="+ctrlId;
	url=url+"&ctrl="+ctrl;		
	window.open(url,"_blank","height=600 width="+popw+" scrollbars=yes,resizable=no,menubar=no,top="+poph+",left="+popl+"" );
}
