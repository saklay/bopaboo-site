
function sortAjaxColumn(url, columnName, className, formName, extraParameters,tag) {
	
	
	
	var frm	= eval("document." + formName);
	var opt;
	opt = eval("document." +formName+".showjmenu.value");
	
	if (eval("frm." + className + "_sortColumn").value == columnName) {
		
		if (eval("frm." + className + "_sortDirection").value == "DESC"){
			
			eval("frm." + className + "_sortDirection").value = "ASC";
		}
		else 
			eval("frm." + className + "_sortDirection").value = "DESC";
	}	
	else {
		eval("frm." + className + "_sortDirection").value = "ASC"
	}
	

	eval("frm." + className + "_sortColumn").value = columnName;

	url = url+"?sortDirection="+eval("frm." + className + "_sortDirection").value+"&sortColumn="+eval("frm." + className + "_sortColumn").value;
	
	if (eval("frm." + className + "_pageIndex") != null) 
		url = url+"&pageIndex="+eval("frm." + className + "_pageIndex").value;

	if(extraParameters!='')
	url = url+"&"+extraParameters;
	
	url = url+"&optionVal="+opt;
	//alert(url);
	try {
		if((tag!=undefined) && (tag!='')) {
			fn_showTab(tag,url);
		}
		else {
			fn_showTab(url);
		}
	}
	catch(e) {
		alert(e);
	}
}

function sortAjaxColumnNew(url, columnName, className, formName, extraParameters,tag) {
	
	var frm	= eval("document." + formName);
	var opt;
	opt = eval("document." +formName+".showjmenu.value");

	if (eval("frm." + className + "_feedSortcolumn").value == columnName) {
		
		if (eval("frm." + className + "_feedSortDirection").value == "DESC"){
			
			eval("frm." + className + "_feedSortDirection").value = "ASC";
		}
		else 
			eval("frm." + className + "_feedSortDirection").value = "DESC";
	}	
	else {
		eval("frm." + className + "_feedSortDirection").value = "DESC"
	}
	

	eval("frm." + className + "_feedSortcolumn").value = columnName;

	url = url+"?feedSortDirection="+eval("frm." + className + "_feedSortDirection").value+"&feedSortcolumn="+eval("frm." + className + "_feedSortcolumn").value;
	
	if (eval("frm." + className + "_pageIndex") != null) 
		url = url+"&pageIndex="+eval("frm." + className + "_pageIndex").value;

	if(extraParameters!='')
	url = url+"&"+extraParameters;
	
	url = url+"&optionVal="+opt;

	fn_showTab(tag,url);
}

function navigateAjaxPage(url, pageIndex, className, formName, extraParameters, tag) {

	if (extraParameters	== null) 
		extraParameters = '';
	

	var frm = eval("document." + formName);
	
	
	
	eval("frm." + className + "_pageIndex").value = pageIndex;
	
	
	

	url = url+"?pageIndex="+pageIndex;

	if (eval("frm." + className + "_sortDirection") != null) 
		url = url+"&sortDirection="+eval("frm." + className + "_sortDirection").value;
	
	if (eval("frm." + className + "_sortColumn") != null) 
		url = url+"&sortColumn="+eval("frm." + className + "_sortColumn").value;
	

	url = url+"&"+extraParameters;

         

	try {
		if((tag!=undefined) && (tag!='')) {
                         
			fn_showTab(tag,url);
		}
		else {
			fn_showTab(url);
		}
	}
	catch(e) {
		alert(e);
	}
}
function goToAjaxPage(url, pageIndex, className, formName, extraParameters, tag) {

	
	
	

	if (extraParameters	== null) 
		extraParameters = '';
	

	var frm = eval("document." + formName);
	
	
	
	eval("frm." + className + "_pageIndex").value = pageIndex;
	
	
	if(pageIndex=='jump'){
		 pageIndex=eval("document." +formName+"."+className+"_jumpTo.value");
		}
	url = url+"?pageIndex="+pageIndex;

	if (eval("frm." + className + "_sortDirection") != null) 
		url = url+"&sortDirection="+eval("frm." + className + "_sortDirection").value;
	
	if (eval("frm." + className + "_sortColumn") != null) 
		url = url+"&sortColumn="+eval("frm." + className + "_sortColumn").value;
	

	url = url+"&"+extraParameters;

	
	try {
		if((tag!=undefined) && (tag!='')) {
			fn_showTab(tag,url);
		}
		else {
			fn_showTab(url);
		}
	}
	catch(e) {
		alert(e);
	}
}
function changeOption(url, pageIndex, className, formName, extraParameters, tag) {

	

	

	if (extraParameters	== null) 
		extraParameters = '';
	
	var optcheck;
	var frm = eval("document." + formName);
	
	opt = eval("document." +formName+".showjmenu.value");
	opt0 = eval("document." +formName+".withinjmenu.value");
	 
	optcheck =eval("document." +formName+".showjmenu.selected");
	optcheck= opt;
	
	eval("frm." + className + "_pageIndex").value = pageIndex;
	
	
	//if(pageIndex=='jump'){
//		 pageIndex=eval("document." +formName+"."+className+"_jumpTo.value");
//		
//		}
	url = url+"?pageIndex="+pageIndex;

	if (eval("frm." + className + "_sortDirection") != null) 
		url = url+"&sortDirection="+eval("frm." + className + "_sortDirection").value;
	
	if (eval("frm." + className + "_sortColumn") != null) 
		url = url+"&sortColumn="+eval("frm." + className + "_sortColumn").value;
	
extraParameters = extraParameters+"optionVal="+opt+"&optionVal0="+opt0;
	//url = url+"&"+extraParameters+"optionVal="+opt;
url = url+"&"+extraParameters;
	fn_showTab(tag,url);
}
function changeSearchOption(url, pageIndex, className, formName, extraParameters) {

	if (extraParameters	== null) 
		extraParameters = '';
	
	var optcheck;
	var frm = eval("document." + formName);
	
	switch(frm.sortMenu.value) {
				case '1':
					
						frm.clsbpFileDetails_sortColumn.value = "dt_FileUploaded";
						frm.clsbpFileDetails_sortDirection.value="DESC";
						break;
				case '2':
						frm.clsbpFileDetails_sortColumn.value = "dt_FileUploaded";
						frm.clsbpFileDetails_sortDirection.value="ASC";
						break;
				case '3':
						frm.clsbpFileDetails_sortColumn.value = "dbl_price";
						frm.clsbpFileDetails_sortDirection.value="DESC";
						break;
				case '4':
						frm.clsbpFileDetails_sortColumn.value = "dbl_price";
						frm.clsbpFileDetails_sortDirection.value="ASC";
						break;
				case '5':
						frm.clsbpFileDetails_sortColumn.value = "avgRating";
						frm.clsbpFileDetails_sortDirection.value="ASC";
						break;
				case '6':
						frm.clsbpFileDetails_sortColumn.value = "avgRating";
						frm.clsbpFileDetails_sortDirection.value="DESC";
						break;
		}
	

	
	
	opt = eval("document." +formName+".sortMenu.value");
		 
	optcheck =eval("document." +formName+".sortMenu.selected");
	optcheck= opt;
	
	 pageIndex=eval("frm." + className + "_pageIndex").value ;
	
	
	//if(pageIndex=='jump'){
//		 pageIndex=eval("document." +formName+"."+className+"_jumpTo.value");
//		
//		}
	url = url+"?pageIndex="+pageIndex;

	if (eval("frm." + className + "_sortDirection").value != '') 
		url = url+"&"+className+"_sortDirection="+eval("frm." + className + "_sortDirection").value;
	
	if (eval("frm." + className + "_sortColumn").value != '') 
		url = url+"&"+className+"_sortColumn="+eval("frm." + className + "_sortColumn").value;

        if (eval("frm." + className + "_bi_GenreId").value != '') 
		url = url+"&"+className+"_bi_GenreId="+eval("frm." + className + "_bi_GenreId").value;
	
	if(eval("frm." + className + "_vc_tags") != undefined){
		if (eval("frm." + className + "_vc_tags").value != '') 
			url = url+"&"+className+"_vc_tags="+eval("frm." + className + "_vc_tags").value;
	}

         if (eval("frm." + className + "_txtSearch").value != '') 
		url = url+"&"+className+"_txtSearch="+eval("frm." + className + "_txtSearch").value;
	
	if (eval("frm." + className + "_seachCat").value != '') 
		url = url+"&seachCat="+eval("frm." + className + "_seachCat").value;
 
 	if(eval("frm." + className + "_SearchGenreId") != undefined) {
		if (eval("frm." + className + "_SearchGenreId").value != '') 
			url = url+"&"+className+"_SearchGenreId="+eval("frm." + className + "_SearchGenreId").value;
	}
	
	if(eval("frm." + className + "_SearchGenreName") != undefined) {
		if (eval("frm." + className + "_SearchGenreName").value != '') 
			url = url+"&"+className+"_SearchGenreName="+eval("frm." + className + "_SearchGenreName").value;
	}

	if(eval("frm." + className + "_Search_tags") != undefined) {
		if (eval("frm." + className + "_Search_tags").value != '') 
			url = url+"&"+className+"_Search_tags="+eval("frm." + className + "_Search_tags").value;
	}
	
	if(eval("frm." + className + "_artist") != undefined) {
		if (eval("frm." + className + "_artist").value != '') 
			url = url+"&"+className+"_artist="+eval("frm." + className + "_artist").value;
	}

         if(eval("frm." + className + "_album") != undefined) {
		if (eval("frm." + className + "_album").value != '')
			url = url+"&"+className+"_album="+eval("frm." + className + "_album").value;
	}
	
	 if(eval("frm." + className + "_goBack").value != undefined) {
		if (eval("frm." + className + "_goBack").value != '') 
			url = url+"&"+className+"_goBack="+eval("frm." + className + "_goBack").value;
	}


	
extraParameters = extraParameters+"&optionVal="+opt;
	//url = url+"&"+extraParameters+"optionVal="+opt;
url = url+"&"+extraParameters;
	fn_showTab(url);
}




function isValidIP(ipAddress) {

   var re = /^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/;
   if (re.test(ipAddress)) {
	  var parts = ipAddress.split(".");
	  if (parseInt(parseFloat(parts[0])) == 0) { return false; }
	  for (var i=0; i<parts.length; i++) {
		 if (parseInt(parseFloat(parts[i])) > 255) { return false; }
	  }
	  return true;
   } 
   else {
	  return false;
   }
}

// Checks the first occurance of spaces and removes them
function trimSpaces(stringValue) {

	for(i = 0; i < stringValue.length; i++) {
		if(stringValue.charAt(i) != " ") {
			break;
		}
	}
	if(i > 0) {
		stringValue = stringValue.substring(i);
	}
	
	// Checks the last occurance of spaces and removes them
	strLength = stringValue.length - 1;
	for(i = strLength; i >= 0; i--) {
		if(stringValue.charAt(i) != " ") {
			break;
		}
	}
	if(i < strLength) {
		stringValue = stringValue.substring(0, i + 1);
	}
	
	// Returns the string after removing leading and trailing spaces.
	return stringValue;
}

//function limitText used to limit text in a textarea
function limitText(field,maxlimit,remark) {

	if (field.value.length > maxlimit) {
		field.value = field.value.substring(0, maxlimit);
	}
	else {
		if(remark) {
			remark.value = maxlimit - field.value.length;
		}
	}	
}

function emailcheck(string){
		
	// 			/ 		open search
	//			a-z 	charcters 
	//			\d		digit	
	var invalidCharactersRegExp = /[^a-z\d.@_-]/i; 
	var isValid = !(invalidCharactersRegExp.test(string) );
	return isValid;
}
	
function selectAll(objItems, objStatus) {
	
	 if(objItems!=null) {
		if(objItems.length>1) {
			for(i=0; i<objItems.length; i++) 
				objItems[i].checked = objStatus.checked;
		} 
		
		objItems.checked = objStatus.checked;    	
	}
	
	changeCheckedColorForSelAll(objItems);
}

//Uncheck control.
function resetChkBox(objItems, objStatus) {
	
	var flag = 0;
	
	if(objItems!=null) {
		
		if(objItems.length == null){
			if(objItems.checked == true){
				flag = 0;
			}
			else
			{
				flag++;
			}
		}
	
		for(i=0; i<objItems.length; i++) {
			if(objItems[i].checked == false){
				flag++;
			}
		} 
		if(flag == 0) {
			objStatus.checked = true;
		}
		else {
			objStatus.checked = false;
		}
	}
}

function checkEmail(email) {

	var str = email;
	var invalidCharactersRegExp = /[^a-z\d\@\_\.-]/i; 
	
	var reg1 = /(@.*@)|(\.\.)|(@\.)|(\.@)|(^\.^\!^\#)/; // not valid
	var reg2 = /^.+\@(\[?)[a-zA-Z0-9\-\.]+\.([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/; // valid
	//var reg3 = /^[^@]+@[^@]+.[a-z]{2,}$/i;
	
	if (!reg1.test(str) && reg2.test(str))
	{
		return true;
	}else{
		return false;
	}
	if(!invalidCharactersRegExp.test(str)) {
		//alert("here");
		return true;
	}else {
		return false;	
	}
}

function nameCheck(string){
		
	// 			/ 		open search
	//			a-z 	charcters 
	//			\d		digit	
	var invalidCharactersRegExp = /[^a-z\d\'\s\-.\/& ]/i; 
	var isValid = !(invalidCharactersRegExp.test(string) );
	return isValid;
}

function checkPassword (strng) {

	var error = "";
	var illegalChars = /[\W_]/; 
	
	if ((strng.length < 4) || (strng.length > 15)) 
	{
  		error = "The password is of wrong length(valid length 4-15 chars).\n";
	}
	else if (illegalChars.test(strng)) 
	{
		error = "Password contains invalid characters";
	}
	return error;
}

function designationCheck(string){
		
		// 			/ 		open search
		//			a-z 	charcters 
		//			\d		digit	
	  var invalidCharactersRegExp = /[^a-z\d\'\-.()\/& ]/i; 
	  var isValid = !(invalidCharactersRegExp.test(string) );
	  return isValid;
}
	
function phoneCheck(string){
		
		// 			/ 		open search
		//			a-z 	charcters 
		//			\d		digit	
	  var invalidCharactersRegExp = /[^\d\-()+ ]/i; 
	  var isValid = !(invalidCharactersRegExp.test(string) );
	  return isValid;
}
	
function mobileCheck(string){
		
	// 			/ 		open search
	//			a-z 	charcters 
	//			\d		digit	
	var invalidCharactersRegExp = /[^\d\-+ ]/i; 
	var isValid = !(invalidCharactersRegExp.test(string) );
	return isValid;
}

function zipCheck(string){
		
	// 			/ 		open search
	//			a-z 	charcters 
	//			\d		digit	
	var invalidCharactersRegExp = /[^a-z\d\-]/i; 
	var isValid = !(invalidCharactersRegExp.test(string) );
	return isValid;
}
	
function sortColumn(columnName, className, formName, extraParameters) {
	
	var frm	= eval("document." + formName);
	
	if (eval("frm." + className + "_sortColumn").value == columnName) {
		if (eval("frm." + className + "_sortDirection").value == "DESC") 
			eval("frm." + className + "_sortDirection").value = "ASC";
		else 
			eval("frm." + className + "_sortDirection").value = "DESC";
	}	
	else {
		eval("frm." + className + "_sortDirection").value = "DESC"
	}
	

	eval("frm." + className + "_sortColumn").value = columnName;

	frm.action = "?sortDirection="+	eval("frm." + className + "_sortDirection").value+"&sortColumn="+eval("frm." + className + "_sortColumn").value;

	if (eval("frm." + className + "_pageIndex") != null) 
		frm.action += "&pageIndex="+eval("frm." + className + "_pageIndex").value;

	frm.action += "&"+extraParameters;
	
	frm.target = "_top";
	
	frm.submit();
}

function navigatePage(pageIndex, className, formName, extraParameters) {
	
	if (extraParameters	== null) 
		extraParameters = '';

	var frm = eval("document." + formName);
	eval("frm." + className + "_pageIndex").value = pageIndex;

	frm.action = "?pageIndex="+pageIndex;

	if (eval("frm." + className + "_sortDirection") != null) 
		frm.action += "&sortDirection="+eval("frm." + className + "_sortDirection").value;
	
	if (eval("frm." + className + "_sortColumn") != null) 
		frm.action += "&sortColumn="+eval("frm." + className + "_sortColumn").value;
	
	frm.action += "&"+extraParameters;

	frm.submit();
}

function getCheckedItem(formName , objCheckBox) {

	var selectedValue = "";
	
	
	for(var i=0;i<formName.elements[objCheckBox].length;i++)
	{
	  	if (formName.elements[objCheckBox][i].checked)
		{
	 		 if (selectedValue != "")
			   {
				selectedValue += ",";	
			   }
			selectedValue	+= formName.elements[objCheckBox][i].value + "";
			

		} 	
	}	
	
 	if (formName.elements[objCheckBox].checked) {
 	   selectedValue = formName.elements[objCheckBox].value;
 	}
 	
	return selectedValue;
	
}

function getSelectedItem(formName , objList) {

	var selectedValue = "";


	for(var i=0;i<formName.elements[objList].length;i++)
	{
	  	if (formName.elements[objList][i].selected)
		{
	 		 if (selectedValue != "")
			   {
				selectedValue += ",";	
			   }
			selectedValue	+= formName.elements[objList][i].value + "";
		} 	
	}	
	if (selectedValue == "") {
		selectedValue = formName.elements[objList].value;
	}
	
	return selectedValue;
	
}

//Convert the date in "MM/DD/YYYY HH:MM:SS" to "DD-MMM-YYYY HH:MM:SS"
function jsDateToMydate(datestr) {
	var m_names = new Array("", "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov","Dec");
	var retarray = datestr.split("/");
	return(retarray[1] + "-" +  m_names[parseInt(retarray[0])] + "-" + retarray[2]);
}

function trim(str) {
	   //   /            open search
	   //     ^            beginning of string
	   //     \s           find White Space, space, TAB and Carriage Returns
	   //     +            one or more
	   //   |            logical OR
	   //     \s           find White Space, space, TAB and Carriage Returns
	   //     $            at end of string
	   //   /            close search
	   //   g            global search
	
	   return str.replace(/^\s+|\s+$/g, "");
}

//The Following section from function hasOptions(obj) to function addOption(obj,text,value,selected) is used to add
// Options from one list box to anoter and vise versa.
// And also used to move up move down ..sort operations.
//  Utility function to determine if a select object has an options array
// -------------------------------------------------------------------
function hasOptions(obj) {

	if (obj!=null && obj.options!=null) { return true; }
	return false;
}

// -------------------------------------------------------------------
// selectUnselectMatchingOptions(select_object,regex,select/unselect,true/false)
//  This is a general function used by the select functions below, to
//  avoid code duplication
// -------------------------------------------------------------------
function selectUnselectMatchingOptions(obj,regex,which,only) {

	if (window.RegExp) {
		if (which == "select") {
			var selected1=true;
			var selected2=false;
			}
		else if (which == "unselect") {
			var selected1=false;
			var selected2=true;
			}
		else {
			return;
			}
		var re = new RegExp(regex);
		if (!hasOptions(obj)) { return; }
		for (var i=0; i<obj.options.length; i++) {
			if (re.test(obj.options[i].text)) {
				obj.options[i].selected = selected1;
				}
			else {
				if (only == true) {
					obj.options[i].selected = selected2;
					}
				}
			}
		}
	}
		
// -------------------------------------------------------------------
// selectMatchingOptions(select_object,regex)
//  This function selects all options that match the regular expression
//  passed in. Currently-selected options will not be changed.
// -------------------------------------------------------------------
function selectMatchingOptions(obj,regex) {
	selectUnselectMatchingOptions(obj,regex,"select",false);
	}
// -------------------------------------------------------------------
// selectOnlyMatchingOptions(select_object,regex)
//  This function selects all options that match the regular expression
//  passed in. Selected options that don't match will be un-selected.
// -------------------------------------------------------------------
function selectOnlyMatchingOptions(obj,regex) {
	selectUnselectMatchingOptions(obj,regex,"select",true);
	}
// -------------------------------------------------------------------
// unSelectMatchingOptions(select_object,regex)
//  This function Unselects all options that match the regular expression
//  passed in. 
// -------------------------------------------------------------------
function unSelectMatchingOptions(obj,regex) {
	selectUnselectMatchingOptions(obj,regex,"unselect",false);
	}
	
// -------------------------------------------------------------------
// sortSelect(select_object)
//   Pass this function a SELECT object and the options will be sorted
//   by their text (display) values
// -------------------------------------------------------------------
function sortSelect(obj) {
	var o = new Array();
	if (!hasOptions(obj)) { return; }
	for (var i=0; i<obj.options.length; i++) {
		o[o.length] = new Option( obj.options[i].text, obj.options[i].value, obj.options[i].defaultSelected, obj.options[i].selected) ;
		}
	if (o.length==0) { return; }
	o = o.sort( 
		function(a,b) { 
			if ((a.text+"") < (b.text+"")) { return -1; }
			if ((a.text+"") > (b.text+"")) { return 1; }
			return 0;
			} 
		);

	for (var i=0; i<o.length; i++) {
		obj.options[i] = new Option(o[i].text, o[i].value, o[i].defaultSelected, o[i].selected);
		}
	}

// -------------------------------------------------------------------
// selectAllOptions(select_object)
//  This function takes a select box and selects all options (in a 
//  multiple select object). This is used when passing values between
//  two select boxes. Select all options in the right box before 
//  submitting the form so the values will be sent to the server.
// -------------------------------------------------------------------
function selectAllOptions(obj) {
	if (!hasOptions(obj)) { return; }
	for (var i=0; i<obj.options.length; i++) {
		obj.options[i].selected = true;
		}
	}
	
// -------------------------------------------------------------------
// moveSelectedOptions(select_object,select_object[,autosort(true/false)[,regex]])
//  This function moves options between select boxes. Works best with
//  multi-select boxes to create the common Windows control effect.
//  Passes all selected values from the first object to the second
//  object and re-sorts each box.
//  If a third argument of 'false' is passed, then the lists are not
//  sorted after the move.
//  If a fourth string argument is passed, this will function as a
//  Regular Expression to match against the TEXT or the options. If 
//  the text of an option matches the pattern, it will NOT be moved.
//  It will be treated as an unmoveable option.
//  You can also put this into the <SELECT> object as follows:
//    onDblClick="moveSelectedOptions(this,this.form.target)
//  This way, when the user double-clicks on a value in one box, it
//  will be transferred to the other (in browsers that support the 
//  onDblClick() event handler).
// -------------------------------------------------------------------
function moveSelectedOptions(from,to) {
// Unselect matching options, if required
	var directFlag = 0;
	listOfAssignedUsers = "";
	if (arguments.length>3) {
		var regex = arguments[3];
		//regex = "-";
//This line is added to check dependancy function dependancyList(from) is in .template/lcProjectAssignment.tmpl.php 
		if (regex != "") {
			//unSelectMatchingOptions(from,regex);
			//alert("Cannot Remove From List\n  Dependancy Error :  PM have TLs or TMs under him.");
			}
		}

	// Move them over
	if (!hasOptions(from)) {return;}
	
	for (var i=0; i < from.options.length; i++) {
		var dependFlag = 0;
		var parFlag = 0;
		var o = from.options[i];
		
		if (o.selected) {
			
		dependFlag = dependancyList(o.value);	
		
		if(dependFlag == 1){
			o.selected = false;
			alert("Dependancy Error:\n  Cannot Remove "+ o.text.toUpperCase() +" From List\n\n  Error : "+ o.text.toUpperCase() +" have following users assigned Under him.\n\n"+valdependancyString);
			continue;
		}
		
// Checking for project assignment for PAR integration.
		if(from.id == "clslcProjectAssignment_users"){
			if(parseInt(assignedUserId) == parseInt(headId)){
				directFlag = 1;	
			}		
			else
			{
				parFlag	= isValidAssignment(o.value, assignedUserId, o.text);
				if(parFlag == 0){
					//alert(" Sorry!!! \n"+ o.text.toUpperCase() +" can be assigned only under \n\n " + valAssignedUnderString);
					listOfAssignedUsers = listOfAssignedUsers + " \n " + o.text.toUpperCase() +" can be assigned only under -> " + valAssignedUnderString;				
					o.selected = false;
					continue;
				}
			}
		}
		
// Checking for regular expression.			
/*
			if (regex != ""){
				var re = new RegExp(regex);
			if (re.test(o.text)) {
					o.selected = false;
					alert(" Dependancy Error:\n  Cannot Remove "+ o.text.toUpperCase() +"  From List\n  Error : "+ o.text.toUpperCase() +" have TLs or TMs under him.");
					//alert("can't move"+o.text);
					continue;
				}			
			}
*/			
			if (!hasOptions(to)) { var index = 0; } else { var index=to.options.length;}
			to.options[index] = new Option( o.text, o.value, false, false);
//Added to keep selecetion. on 18-10-05.			
			to.options[index].selected = true;
			}
		}
	// Delete them from original
	for (var i=(from.options.length-1); i>=0; i--) {
		var o = from.options[i];
		if (o.selected) {
			from.options[i] = null;
			}
		}
	if ((arguments.length<3) || (arguments[2]==true)) {
			sortSelect(from);
			if(from.id == "clslcProjectAssignment_users"){
				sortSelect(to);
			}
		}
	//from.selectedIndex = -1;
	//to.selectedIndex = -1;

// To display assigned under validation in a single messagebox.
		if(listOfAssignedUsers != ""){	
			alert(listOfAssignedUsers);
		}
		
		listOfAssignedUsers = "";
	// If all users assigned under the director.
		if(directFlag == 1){
			alert("The selected users has been assigned under Director");
		}
	}	

// -------------------------------------------------------------------
// copySelectedOptions(select_object,select_object[,autosort(true/false)])
//  This function copies options between select boxes instead of 
//  moving items. Duplicates in the target list are not allowed.
// -------------------------------------------------------------------
function copySelectedOptions(from,to) {
	var options = new Object();
	if (hasOptions(to)) {
		for (var i=0; i<to.options.length; i++) {
			options[to.options[i].value] = to.options[i].text;
			}
		}
	if (!hasOptions(from)) { return; }
	for (var i=0; i<from.options.length; i++) {
		var o = from.options[i];
		if (o.selected) {
			if (options[o.value] == null || options[o.value] == "undefined" || options[o.value]!=o.text) {
				if (!hasOptions(to)) { var index = 0; } else { var index=to.options.length; }
				to.options[index] = new Option( o.text, o.value, false, false);
				}
			}
		}
	if ((arguments.length<3) || (arguments[2]==true)) {
		sortSelect(to);
		}
	from.selectedIndex = -1;
	to.selectedIndex = -1;
	}

// -------------------------------------------------------------------
// moveAllOptions(select_object,select_object[,autosort(true/false)[,regex]])
//  Move all options from one select box to another.
// -------------------------------------------------------------------
function moveAllOptions(from,to) {
	selectAllOptions(from);
	if (arguments.length==2) {
		moveSelectedOptions(from,to);
		}
	else if (arguments.length==3) {
		moveSelectedOptions(from,to,arguments[2]);
		}
	else if (arguments.length==4) {
		moveSelectedOptions(from,to,arguments[2],arguments[3]);
		}
	}

// -------------------------------------------------------------------
// copyAllOptions(select_object,select_object[,autosort(true/false)])
//  Copy all options from one select box to another, instead of
//  removing items. Duplicates in the target list are not allowed.
// -------------------------------------------------------------------
function copyAllOptions(from,to) {
	selectAllOptions(from);
	if (arguments.length==2) {
		copySelectedOptions(from,to);
		}
	else if (arguments.length==3) {
		copySelectedOptions(from,to,arguments[2]);
		}
	}

// -------------------------------------------------------------------
// swapOptions(select_object,option1,option2)
//  Swap positions of two options in a select list
// -------------------------------------------------------------------
function swapOptions(obj,i,j) {
	var o = obj.options;
	var i_selected = o[i].selected;
	var j_selected = o[j].selected;
	var temp = new Option(o[i].text, o[i].value, o[i].defaultSelected, o[i].selected);
	var temp2= new Option(o[j].text, o[j].value, o[j].defaultSelected, o[j].selected);
	o[i] = temp2;
	o[j] = temp;
	o[i].selected = j_selected;
	o[j].selected = i_selected;
	}
	
// -------------------------------------------------------------------
// moveOptionUp(select_object)
//  Move selected option in a select list up one
// -------------------------------------------------------------------
function moveOptionUp(obj) {
	if (!hasOptions(obj)) { return; }
	for (i=0; i<obj.options.length; i++) {
		if (obj.options[i].selected) {
			if (i != 0 && !obj.options[i-1].selected) {
				swapOptions(obj,i,i-1);
				obj.options[i-1].selected = true;
				}
			}
		}
	}

// -------------------------------------------------------------------
// moveOptionDown(select_object)
//  Move selected option in a select list down one
// -------------------------------------------------------------------
function moveOptionDown(obj) {
	if (!hasOptions(obj)) { return; }
	for (i=obj.options.length-1; i>=0; i--) {
		if (obj.options[i].selected) {
			if (i != (obj.options.length-1) && ! obj.options[i+1].selected) {
				swapOptions(obj,i,i+1);
				obj.options[i+1].selected = true;
				}
			}
		}
	}

// -------------------------------------------------------------------
// removeSelectedOptions(select_object)
//  Remove all selected options from a list
//  (Thanks to Gene Ninestein)
// -------------------------------------------------------------------
function removeSelectedOptions(from) { 
	if (!hasOptions(from)) { return; }
	if (from.type=="select-one") {
		from.options[from.selectedIndex] = null;
		}
	else {
		for (var i=(from.options.length-1); i>=0; i--) { 
			var o=from.options[i]; 
			if (o.selected) { 
				from.options[i] = null; 
				} 
			}
		}
	from.selectedIndex = -1; 
	} 


// -------------------------------------------------------------------
// removeAllOptions(select_object)
//  Remove all options from a list
// -------------------------------------------------------------------
function removeAllOptions(from) { 
	if (!hasOptions(from)) { return; }
	for (var i=(from.options.length-1); i>=0; i--) { 
		from.options[i] = null; 
		} 
	from.selectedIndex = -1; 
	} 

// -------------------------------------------------------------------
// addOption(select_object,display_text,value,selected)
//  Add an option to a list
// -------------------------------------------------------------------
function addOption(obj,text,value,selected) {
	if (obj!=null && obj.options!=null) {
		obj.options[obj.options.length] = new Option(text, value, false, selected);
		}
	}
//===============End of Code For List Box Population.===========================//

function changeDateformat(datestr) {
	var retarray = datestr.split("-");
	return(retarray[1] + "/" +  retarray[2] + "/" + retarray[0]);
}
function dateTimeDiff( start, end, interval, rounding ) {

	
   var iOut = 0;
	
    // Create 2 error messages, 1 for each argument. 
    var startMsg = "Check the Start Date and End Date\n"
        startMsg += "must be a valid date format.\n\n"
        startMsg += "Please try again." ;
		
    var intervalMsg = "Sorry the dateAdd function only accepts\n"
        intervalMsg += "d, h, m OR s intervals.\n\n"
        intervalMsg += "Please try again." ;

    var bufferA = Date.parse(start) ;
    var bufferB = Date.parse(end) ;
    	
    // check that the start parameter is a valid Date. 
    if ( isNaN (bufferA) || isNaN (bufferB) ) {
        //alert( startMsg ) ;
        return null ;
    }
	
    // check that an interval parameter was not numeric. 
    if ( interval.charAt == 'undefined' ) {
        // the user specified an incorrect interval, handle the error. 
        //alert( intervalMsg ) ;
        return null ;
    }
    
    var number = bufferB-bufferA ;

    // what kind of add to do? 
    switch (interval.charAt(0))
    {
        case 'd': case 'D': 
            iOut = parseInt(number / 86400000) ;
            if(rounding) iOut += parseInt((number % 86400000)/43200001) ;
            break ;
        case 'h': case 'H':
            iOut = parseInt(number / 3600000 ) ;
            if(rounding) iOut += parseInt((number % 3600000)/1800001) ;
            break ;
        case 'm': case 'M':
            iOut = parseInt(number / 60000 ) ;
            if(rounding) iOut += parseInt((number % 60000)/30001) ;
            break ;
        case 's': case 'S':
            iOut = parseInt(number / 1000 ) ;
            if(rounding) iOut += parseInt((number % 1000)/501) ;
            break ;
        default:
        // If we get to here then the interval parameter
        // didn't meet the d,h,m,s criteria.  Handle
        // the error. 		
        alert(intervalMsg) ;
        return null ;
    }
    
    return iOut ;
}
var dtCh= "/";
var minYear=1900;
var maxYear=2100;

function DaysArray(n) {
	for (var i = 1; i <= n; i++) {
		this[i] = 31
		if (i==4 || i==6 || i==9 || i==11) {this[i] = 30}
		if (i==2) {this[i] = 29}
   } 
   return this
}
function daysInFebruary (year){
	// February has 29 days in any year evenly divisible by four,
    // EXCEPT for centurial years which are not also divisible by 400.
    return (((year % 4 == 0) && ( (!(year % 100 == 0)) || (year % 400 == 0))) ? 29 : 28 );
}
function isInteger(s){
	var i;
    for (i = 0; i < s.length; i++){   
        // Check that current character is number.
        var c = s.charAt(i);
        if (((c < "0") || (c > "9"))) return false;
    }
    // All characters are numbers.
    return true;
}
function stripCharsInBag(s, bag){
	var i;
    var returnString = "";
    // Search through string's characters one by one.
    // If character is not in bag, append to returnString.
    for (i = 0; i < s.length; i++){
        var c = s.charAt(i);
        if (bag.indexOf(c) == -1) returnString += c;
    }
    return returnString;
}

function isDate(dtStr){
	
	var daysInMonth = DaysArray(12)
	var pos1=dtStr.indexOf(dtCh)
	var pos2=dtStr.indexOf(dtCh,pos1+1)
	var strMonth=dtStr.substring(0,pos1)
	var strDay=dtStr.substring(pos1+1,pos2)
	var strYear=dtStr.substring(pos2+1)
	
	strYr=strYear
	if (strDay.charAt(0)=="0" && strDay.length>1) strDay=strDay.substring(1)
	if (strMonth.charAt(0)=="0" && strMonth.length>1) strMonth=strMonth.substring(1)
	for (var i = 1; i <= 2; i++) {
		if (strYr.charAt(0)=="0" && strYr.length>1) strYr=strYr.substring(1)
	}
	var month=parseInt(strMonth)
	var day=parseInt(strDay)
	var year=parseInt(strYr)
	if (pos1==-1 || pos2==-1){
		alert("The date format should be : mm/dd/yy")
		return false
	}
	if (strMonth.length<1 || month<1 || month>12){
		alert("Please enter a valid month")
		return false
	}
	if (strDay.length<1 || day<1 || day>31 || (month==2 && day>daysInFebruary(year)) || day > daysInMonth[month]){
		alert("Please enter a valid day")
		return false
	}
	if (strYear.length != 4 || year==0 || year<minYear || year>maxYear){
		alert("Please enter a valid 2 digit year between "+minYear+" and "+maxYear)
		return false
	}
	if (dtStr.indexOf(dtCh,pos2+1)!=-1 || isInteger(stripCharsInBag(dtStr, dtCh))==false){
		alert("Please enter a valid date")
		return false
	} 
return true 
}
function DtDiff(date1, date2) {
   dte1 = new Date(Date.parse(date1));
   dte2 = new Date(Date.parse(date2));

    if (isNaN (dte1) || isNaN (dte2) ) {
        alert("Invalid date parameters") ;
        return null ;
    }


   diff = Math.abs(dte1.getTime() - dte2.getTime());

	days = 0;
	hours = 0;
	minutes = 0;
	seconds = 0;
  if((diff % 86400000) > 0)
   {
       rest = (diff % 86400000);
       days = (diff - rest) / 86400000;
       
       if((rest % 3600000) > 0 )
       {
           rest1 = (rest % 3600000);
           hours = (rest - rest1) / 3600000;
     

           if((rest1 % 60000) > 0 )
           {
               rest2 = (rest1 % 60000);
               minutes = (rest1 - rest2) / 60000;
               seconds = rest2/1000;
           }else{
               minutes = rest1 / 60000;
		   }
      }else{
           hours = rest / 3600000;
	   }
   }else{
       days = diff / 86400000;
	}

	var retarray = new Array(4);
	retarray[0]= days;
	retarray[1]= hours;
	retarray[2]= minutes;
	retarray[3]= seconds;
	return retarray;
}

function removeSpaceBetweenWords(control,string){
	
	if(trim(string)==""){
		return false;
	}
	var string1 = "";
	var m=0;
	var n=0;
	var flag =0;
	for(var i=0; i < string.length; i++){

		if((string.charAt(i) == " ") && (string.charAt(i+1) == " ")){
			string1 = string1+string.charAt(i);
			i++;
			flag++;
		}
		else
		{
			string1 = string1+string.charAt(i);			
		}
	}
	
	if(flag ==0){
		control.value = string1;
		return true; 
	}
	else
	{
		 removeSpaceBetweenWords(control,string1);
	}
	
}	

function printSetup(pageName) {

	// Allowed pages
	var arrPageName = new Array('lcDailyThoughtList.php', 'lcSelfAppraisalReport.php', 'lcDailySarList.php', 'lcMyWorkStatus.php', 'lcDailyAttendanceReport.php', 'lcAttendanceReport.php', 'lcUserReport.php', 'lcWorkStatusReport.php', 'lcSurveyReport.php', 'lcWorkStatusPopUp.php', 'lcMyAttendance.php', 'lcProductivityReport.php', 'lcProjectTree.php', 'lcYearlyAttendanceUserReport.php', 'lcAttendanceUserReport.php', 'lcFeedbackList.php') ; 
	
	// Check if the page requested in the allowed list
	var flag = 0;
	for(var i=0; i < arrPageName.length; i++) {
		if(arrPageName[i] == pageName) {
			flag = 1;
			break;
		}
	}

	if (flag == 0) return false;

	var a = document.all.item("noPrint");
	
	if (a!=null) {
		if (a.length!=null) {
			for (i=0; i< a.length; i++) {
				a(i).style.display = window.event.type == "beforeprint" ? "none" :"inline";
			}
		} 
		else { 
			a.style.display = window.event.type == "beforeprint" ? "none" :"inline";
		}
	}
} 

//function:minuteToHM - convert minute to hour:minute
function minuteToHM(minute) {
	var sign = "";
	if(minute < 0) {
		sign = "-";
	}	

	var minute = parseInt(Math.abs(minute));

	var hour = parseInt(minute/60);
	var fract = minute % 60;
	var hh = hour;
	var mm = Math.floor(fract);

	if (hh <= 9) hh = "0"+hh ;
	if (mm <= 9) mm = "0"+mm ;
	
	return sign+hh+":"+mm ;	
}
// functions used for auto complete drop down
var keyTime, keyStr = '', lastKey;
var agt=navigator.userAgent.toLowerCase();
var is_ie = ((agt.indexOf("msie") != -1) && (agt.indexOf("opera") == -1));

function setSelection(element) {
  if(is_ie)  {
	var currentKey = unescape('%' + window.event.keyCode.toString(16)).toLowerCase();
	var idx, currentSIdx = element.selectedIndex;
    var newTime = new Date().getTime();
    if(keyTime != null && newTime - keyTime < 500) // if two keys were pressed between 0.3 seconds (can be customized), do type-ahead
    {
      keyStr += currentKey;
      idx = findIdx(element);
    }
    else // unfortunately we seem to have to handle default browser behavior too
    {
      keyStr = currentKey;
      var selectFirst = true;
      if(keyStr == lastKey)  {
        idx = currentSIdx + 1;
        if(idx < element.options.length && element.options[idx].text.charAt(0) == lastKey)
          selectFirst = false;
      }
      if(selectFirst) idx = findIdx(element);
      lastKey = currentKey;
    }
    if(idx >= 0)   {
		element.options[currentSIdx].selected = false;
     	element.options[idx].selected = true;
    }
  }
}

function findIdx(element) {
  var idx = -1, len = keyStr.length;
  for(var i = 1; i < element.options.length; i++) {
    var str = element.options[i].text.toLowerCase();
	str = str.substring(0, len); 
	if(keyStr == str) { idx = i; break }
  }
  return idx;
}

function setTime() {
  keyTime = new Date().getTime();
  return false;
}

function HTMLEncode(t) {
    var t = t.toString();
    var h = [["&","&amp;"], ["\"","&quot;"] ,["<","&lt;"], [">","&gt;"]];
    var hl = h.length;
    var tl = t.length;
    var d = "";
    var i = 0;
    if (t) {
        while (i<tl) {
            var c = t.charAt(i++);
            var r = 0;
            for (j=0; j<hl; ++j) {
                if (c == h[j][0]) {
                    d += h[j][1];
                    r = 1;
                    break;
                }
            }
            if (!r) d += c;
        }
    }
	
    return d;
}

	function splitstr(str){
		
		var string1 = "";
		
		if(str.indexOf("\n") == -1){		
			var words = str.split(" ");
			var m=0, n=0;
			var string1 = "";
			if(words.length > 1){
				for (i=0; i<words.length-1; i++){
					m=words[i].length;
					n=words[i+1].length;
					if(words[i].length > 35 ){
						
						words[i] = splitting(words[i]);
					}
					if( (m+n) > 25){
						words[i] = words[i] + "\n" ;
					}
					string1 = string1 +" "+ words[i];
				}
				
				if(words[i].length > 35 ){
						
						words[i] = splitting(words[i]);
					}
				string1 = string1 + " " +words[i];
			}
			else
			{			
				string1 = splitting(str);
			}
		}
		else
		{			
			var words = str.split("\n");
			var string1 = "";
			var m=0;
			var n=0;
		
			for (i=0; i<words.length-1; i++){
				
				m=words[i].length;
				n=words[i+1].length;

				var words1 = words[i].split(" ");
				
				if( words1.length ==1 ){			
					if(words[i].length > 35 ){
						words[i] = splitting(words[i]);
					}
					if( (m+n) > 25){
						words[i] = words[i] + "\n" ;
					}
				}
				else
				{
					var wordstring="";
					for(j=0; j<words1.length; j++){
						if(words1[j].length >35){
							
							words1[j] = splitting(words1[j]);
								
						}
						wordstring = wordstring + " " + words1[j];
					}
					
					words[i] = wordstring;
				}
				string1 = string1 + words[i];
			}
			
				var words2 = words[i].split(" ");
				if( words2.length ==1 ){
					if(words[i].length > 35 ){
								words[i] = splitting(words[i]);
							}
				}
				else
				{
					var wordstring="";
					for(j=0; j<words2.length; j++){
						if(words2[j].length >35){
							
							words2[j] = splitting(words2[j]);
								
						}
						wordstring = wordstring + " " + words2[j];
					}
					
					words[i] = wordstring;
					
				}
			string1 = string1 + words[i];
		}
		return string1;
	}
	
	function splitting(str){
		
			//alert(str);
			var l= str.length;
			var j=0;
			var k;
			var string1="";
			for(var i=1; i < l ; i++){
						if(i % 25 == 0){
							string = str.substring(j,i);
							string1 = string1 + string + "\n";
							string = "";
							j = i;
						}
				}
	
				k = l - j;
				string = str.substring(j,l);
				string1 = string1 + string +"\n" ;
				return string1;
		
		}	
	
	function numcheck(string){
		
		// 			/ 		open search
		//			a-z 	charcters 
		//			\d		digit	
	  var invalidCharactersRegExp = /[^\d]/i;
	  var isValid = !(invalidCharactersRegExp.test(string) );
	  return isValid;
	}	
	
	// allows only numeric
	function numericOnly(e) {
		if(window.event) {
			key = e.keyCode; // for IE, e.keyCode or window.event.keyCode can be used
		}
		else if(e.which) {
			key = e.which; // netscape
		}
		else {
			return true;// no event, so pass through
		}
		
		if( ((key>45) && (key<58)) || (key==8) ) {
			return true; 
		}
		else {
			return false;
		}
		
		/*
		keychar = String.fromCharCode(key);
		reg = /\d/;
		return reg.test(keychar);
		*/
	}
	
	function roundNumber(val,precision) {
		var newVal = Math.round(val*Math.pow(10,precision))/Math.pow(10,precision);
		return newVal ;
	}
	
	//convert ddm-mmm-yyyy To mm/dd/yyyy;
	function ddmmmyyyyToJsdate(datestr) {
		var retarray = datestr.split("-");
		var arrMonth = new Object();
		arrMonth["Jan"] = {value:"01",text:"January"};
		arrMonth["Feb"] = {value:"02",text:"February"};
		arrMonth["Mar"] = {value:"03",text:"March"};
		arrMonth["Apr"] = {value:"04",text:"April"};
		arrMonth["May"] = {value:"05",text:"May"};
		arrMonth["Jun"] = {value:"06",text:"June"};
		arrMonth["Jul"] = {value:"07",text:"July"};
		arrMonth["Aug"] = {value:"08",text:"August"};
		arrMonth["Sep"] = {value:"09",text:"September"};
		arrMonth["Oct"] = {value:"10",text:"October"};
		arrMonth["Nov"] = {value:"11",text:"November"};
		arrMonth["Dec"] = {value:"12",text:"December"};
		var month = arrMonth[retarray[1]];
		return(month.value + "/" + retarray[0] + "/" + retarray[2]);
	}
	
// To split the selected values of a list box to comma seperated string.
function GetSelectedItem(from) {

	if (!hasOptions(from)) { return; }
	listId = "";
	for (var i=0; i<from.options.length; i++) {
		var o = from.options[i];
		if (o.selected) {

					if(listId != "")
					listId  = listId  + ",";
					
					listId = listId + o.value
			} 
		}
	return listId;
} 

function ddmmmyyyyToJsdate(datestr) {
	var retarray = datestr.split("-");
	var arrMonth = new Object();
	arrMonth["Jan"] = {value:"01",text:"January"};
	arrMonth["Feb"] = {value:"02",text:"February"};
	arrMonth["Mar"] = {value:"03",text:"March"};
	arrMonth["Apr"] = {value:"04",text:"April"};
	arrMonth["May"] = {value:"05",text:"May"};
	arrMonth["Jun"] = {value:"06",text:"June"};
	arrMonth["Jul"] = {value:"07",text:"July"};
	arrMonth["Aug"] = {value:"08",text:"August"};
	arrMonth["Sep"] = {value:"09",text:"September"};
	arrMonth["Oct"] = {value:"10",text:"October"};
	arrMonth["Nov"] = {value:"11",text:"November"};
	arrMonth["Dec"] = {value:"12",text:"December"};
	var month = arrMonth[retarray[1]];
	return(month.value + "/" + retarray[0] + "/" + retarray[2]);
}

function openWindow(url,window_name,winWidth,winHeight,fscroll,resize,type) {
	sWidth = screen.availWidth;
	sHeight = screen.availHeight;
	
	sLeft = (sWidth - winWidth) / 2;
	sTop = (sHeight - winHeight) / 2;
	if(fscroll == '') {fscroll = 0}
	if(resize == '') {resize = 'no'}
	
	var popup = window.open(url,window_name,"width=" + winWidth + ",height=" + winHeight + ",top=" + sTop + ",left=" + sLeft + ",toolbar=0,menubar=0,status=0,scrollbars=" + fscroll + ",resizable="+resize);
	
	if(window_name == "pic") {
		popup.document.write('<html><head><title>' + url + '</title></head>');
		popup.document.write('<body topmargin="5" leftmargin="5" marginheight="0" marginwidth="0" onLoad="this.focus()">');
		popup.document.write('<img src="'+url+'" border="0">');
		popup.document.write('</body></html>');
	}
	popup.onLoad = popup.focus() ;	

}
// Below fns will be used for mysql type listing
// controlName is the form object passed as (formName.controlName) 
// id is the value of the control.
function changeCheckedColor(controlName) {
	
	if(controlName!=null) {
		if(controlName.length) {
			if(controlName.length>1) {
				for(i=0; i<controlName.length; i++){
					if(controlName[i].checked){
						id = controlName[i].value;
						document.getElementById("row_"+id).className='checkedRow';

					}
				}
			} 
		}else {
			if(controlName.checked){
				id = controlName.value;
				document.getElementById("row_"+id).className='checkedRow';

			}
		}
	  
	}

}
function changeCheckedColorForSelAll(controlName) {
	if(controlName!=null) {
		if(controlName.length) {
			count = controlName.length;
			for(var i=0;i<count;i++)
			{
				if (controlName[i].checked)
				{	
					id = controlName[i].value;
					if(document.getElementById("row_"+id)!=null) {
						document.getElementById("row_"+id).className='checkedRow';
					}
				}else {
					id = controlName[i].value;
					if(document.getElementById("row_"+id)!=null) {
						document.getElementById("row_"+id).className='rowContent';
					}
				}
			}
		}else {
				if (controlName.checked)
				{	
					id = controlName.value;
					if(document.getElementById("row_"+id)!=null) {
						document.getElementById("row_"+id).className='checkedRow';
					}
				}else {
					id = controlName.value;
					if(document.getElementById("row_"+id)!=null) {
						document.getElementById("row_"+id).className='rowContent';
					}
				}
		}
	}
}
function mouseOverEffect(id) {
			document.getElementById("row_"+id).className='mouseOverRow';
}
function mouseOutEffect(id) {
			if(document.getElementById("row_"+id).className == 'checkedRow') {
				document.getElementById("row_"+id).className='checkedRow';
			}else {
				document.getElementById("row_"+id).className='rowContent';
			}
}
function checkRow(id,controlName) {
	
	if(controlName !=null){
		if(!controlName.length) {
					
					if(controlName.checked == false ) {
						controlName.checked = true;
						document.getElementById("row_"+id).className='checkedRow';
					}
					else {
						controlName.checked = false;
						document.getElementById("row_"+id).className='rowContent';
					}
		}else {
			count = controlName.length;
			
			if(count){
				for(var i=0;i<count;i++)
				{
					if (controlName[i].value == id)
					{	
						if(controlName[i].checked == false) {
							controlName[i].checked = true;
							document.getElementById("row_"+id).className='checkedRow';
						}
						else {
							controlName[i].checked = false;
							document.getElementById("row_"+id).className='rowContent';
						}
					}
				}
			}
		}
		var NS4	= (document.layers)?true:false;
		var IE4 = (document.all)?true:false;
		if(IE4) {
			resetChkBox(controlName, document.all.chkAll);
		}else {
			resetChkBox(controlName, document.layers.chkAll);
		}
	}
}
function chkrepeat(string, str, num){

	var i =0;
	var myString = string;
	var index = myString.indexOf(str);
	while (index != -1) {
		index = myString.indexOf(str, index + 1); // start search after last match found
		i++;
	}
	if(i > num){
	  return false;
	}
	return true;
}

// Validate a control for having any empty entry, if found will give the message specified
//		objControl	- The control which need to be validated
//		caption		- The name that is to be shown in the message
function validateControl(objControl, caption) { 
	
	alert(objControl.type);
	var isValid = true;

	switch (objControl.type) {
		case 'text', 'textarea':	// Textbox; Textarea
			if (objControl.value == '') {
				alert("Please specify " + trim(caption));
				isValid = false;
			}
			break;

		case 'select-one':			// Dropdown
			if (objControl.value == '') {
				alert("Please select " + trim(caption));
				isValid = false;
			}
			break;

		case "select-multiple":		// Listbox
			if (objControl.value == '') {
				alert("Please select atleast one " + trim(caption));
				isValid = false;
			}
			break;
	}

	objControl.focus();
	return isValid;
}
// ---------------------- Function for Banner Rotation Using Ajax -------------------------------------//
function makeHttpRequest(url, callback_function, return_xml)
{
   
   var http_request = false;

   if (window.XMLHttpRequest) { // Mozilla, Safari,...
       http_request = new XMLHttpRequest();
       if (http_request.overrideMimeType) {
           http_request.overrideMimeType('text/xml');
       }

   } else if (window.ActiveXObject) { // IE
       try {
           http_request = new ActiveXObject("Msxml2.XMLHTTP");
       } catch (e) {
           try {
               http_request = new ActiveXObject("Microsoft.XMLHTTP");
           } catch (e) {}
       }
   }

   if (!http_request) {
       alert('Unfortunatelly you browser doesn\'t support this feature.');
       return false;
   }
   http_request.onreadystatechange = function() {
       if (http_request.readyState == 4) {
           if (http_request.status == 200) {
               if (return_xml) {
                   eval(callback_function + '(http_request.responseXML)');
               } else {
                   eval(callback_function + '(http_request.responseText)');
               }
           } else {
               alert('There was a problem with the request.(Code: ' + http_request.status + ')');
           }
       }
   }
   http_request.open('GET', url, true);
   http_request.send(null);
}