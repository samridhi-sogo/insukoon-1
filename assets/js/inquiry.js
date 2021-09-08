/**
* PHP Email Form Validation - v2.3
* URL: https://bootstrapmade.com/php-email-form/
* Author: BootstrapMade.com
*/
!(function($) {
  "use strict";
  
      // Stick the header at top on scroll
	  $("#header").sticky({
		topSpacing: 0,
		zIndex: '50'
	  });

  function resetForm(){
	  var this_form = $('#inquiry-form');
	  this_form.each(function(){
		  this.reset();
		  removeError(this);
		});
	  
  }
  $('.form-btn-cancel').click(function(){
	  resetForm();
  });
  //-----------------------------FILL TIMES CITY/STATE DROP-DOWN LISTS........................ 
  function createFromTimeList(){
	  var select = document.getElementById("field-from-time");
	  var today= new Date();
	  for(var i = 9; i<=17; i++){
		var el = document.createElement("option");
		el.classList.add('field-select-option');
		today.setHours(i);
		today.setMinutes(0);
		el.textContent = pad(today.getHours(),2)+":"+pad(today.getMinutes(),2)+" - "+ pad(today.getHours()+1,2)+":"+pad(today.getMinutes(),2);
		el.value = i;
		select.appendChild(el);
	  }
  }
  function createToTimeList(){
	  var select = document.getElementById("field-to-time");
	  var today= new Date();
	  for(var i = 9; i<=17; i++){
		var el = document.createElement("option");
		el.classList.add('field-select-option');
		today.setHours(i);
		today.setMinutes(0);
		el.textContent = pad(today.getHours(),2)+":"+pad(today.getMinutes(),2)+" - "+pad(today.getHours()+1,2)+":"+pad(today.getMinutes(),2);
		el.value = i;
		select.appendChild(el);
	  }
  }
  function createStateOptions(opt,i) {
	    var select = document.getElementById("field-state"); 
		var el = document.createElement("option");
		el.classList.add('field-select-option');
		el.textContent = opt;
		el.value = opt;
		select.appendChild(el);
	} 
   function createCityOptions(opt,i) {
	    var select = document.getElementById("field-city"); 
		var el = document.createElement("option");
		el.classList.add('field-select-option');
		el.textContent = opt;
		el.value = opt;
		select.appendChild(el);
	} 
  
  function stateCityList(){
	var stateList = document.getElementById('field-state');
	var cityList = document.getElementById('field-city');
	var state = stateList.value;
	   $.ajax({
		url: "forms/inquiryPreFill.php",
		method: "POST",
		data: { 'state' : ''},
		dataType: "jsonp",
		timeout: 40000
	})
	 .then(function(data) {
		// console.log('success callback 1', data) 
		var options = JSON.parse(xhr.responseText);
		options.forEach(createStateOptions);
	  })
	  .catch(function(xhr) {
		  if(xhr.statusText=="OK"){
			 //data = xhr.responseText;
			 // console.log(JSON.parse(xhr.responseText));
			 var options = JSON.parse(xhr.responseText);
			options.forEach(createStateOptions);
		}
	})
  }
  
  function createCityList(){
	var stateList = document.getElementById('field-state');
	var cityList = document.getElementById('field-city');
	var state = stateList.value;
	   $.ajax({
		url: "forms/inquiryPreFill.php",
		method: "POST",
		data: { 'state' : state},
		dataType: "jsonp",
		timeout: 40000
	})
	 .then(function(data) {
		// console.log('success callback 1', data) 
		//console.log(JSON.parse(xhr.responseText));
			 var options = JSON.parse(xhr.responseText);
			 //remove any data already present
			 $('#field-city option').each(function() {
				$(this).remove();
			});
			//<option disabled selected value="" class=""></option>
			var select = document.getElementById("field-city"); 
			var el = document.createElement("option");
			el.selected = true;
			el.disabled = true;
			el.classList.add('form-select-placeholder');
			el.textContent = "";
			el.value = "";
			select.appendChild(el);
			options.forEach(createCityOptions);
	  })
	  .catch(function(xhr) {
		  if(xhr.statusText=="OK"){
			 //data = xhr.responseText;
			 //console.log(JSON.parse(xhr.responseText));
			 var options = JSON.parse(xhr.responseText);
			 //remove any data already present
			 $('#field-city option').each(function() {
				$(this).remove();
			});
			options.forEach(createCityOptions);
		}
	})
  }
  
  $( window ).on("load",(function() {
		// On document-ready, fill drop-down list from DB
		stateCityList();
		createFromTimeList();
		createToTimeList();
	}));
	
  $("#field-state").change(function(){
	 var stateList = document.getElementById('field-state');
	 if(stateList.value == ''){
		 createError(this,'select a valid State of your address');
	 }
	 createCityList(); 
  });

//----------------------------------------KEY-UP EVENTS..................

function removeError(obj){
	var p = obj.parentElement;
	if(!p) return;
	if(p.classList.contains('form-has-error')){
		p.classList.remove('form-has-error');
		p.childNodes.forEach(function(x)
					{if(x.nodeName.toLowerCase().includes('small'))
						{
							p.removeChild(x);
						}
					});
	}
}

function createError(obj,msg){
	removeError(obj);
	var p = obj.parentElement;
	if(!p) return;
	var small = document.createElement('small');
	small.textContent = msg;
	small.classList.add('form-element-hint');
	p.appendChild(small);
	p.classList.add('form-has-error');
}

function createErrorAlt(obj,msg){
	if(!obj.parent()) return;
	var p = obj.parent();
	if(p.hasClass('form-has-error')){
		p.removeClass('form-has-error');
		p.children().each(function(x)
					{if(x.tagName.toLowerCase().includes('small'))
						{
							p.removeChild(x);
						}
					});
	}
	var small = document.createElement('small');
	small.textContent = msg;
	small.classList.add('form-element-hint');
	p.children().add(small);
	p.addClass('form-has-error');
}

function removeErrorAlt(obj,msg){
	if(!obj.parent()) return;
	var p = obj.parent();
	if(p.hasClass('form-has-error')){
		p.removeClass('form-has-error');
		p.children().each(function(x)
					{if(x.tagName.toLowerCase().includes('small'))
						{
							p.removeChild(x);
						}
					});
	}
}

$("body").on("keyup", "#field-org-pin", function (e) {
  var inputValue = $(this).val(); 
  var error_msg = '';
  //console.log(inputValue);
  if(isNaN(inputValue)){
	  error_msg = "PIN Code should only contain numerical values.";
  }
  else{
	  removeError(this);
  }
  if(inputValue.length>6){
	  error_msg = "PIN Code should not be more than 6 Digits.";
  }
  else{
	  removeError(this);
  }
  if(error_msg !==''){
	createError(this,error_msg);
  }
});

$("#field-org-pin").focusout(function(){
	var pin = $(this).val();
	if (pin.length<6) {
		createError(this,'The PIN code must be at least 6 digit long!');
	}
	else{
		removeError(this);
	}
});

$("#field-org-email").focusout(function(){
	var email = $(this).val();
	var emailExp = /^[^\s()<>@,;:\/]+@\w[\w\.-]+\.[a-z]{2,}$/i;
	if (!emailExp.test(email)) {
		createError(this,'The accepted format for email is : contact@example.com');
	}
	else{
		removeError(this);
	}
});

$("#field-org-website").focusout(function(){
	var website = $(this).val();
	var websiteExp = /^(https?:\/\/)?(www\.)?([a-zA-Z0-9]+(-?[a-zA-Z0-9])*\.)+[\w]{2,}(\/\S*)?$/ig;
	if (!websiteExp.test(website)) {
		createError(this,'The accepted format for email is : https://www.example.com');
	}	
	else{
		removeError(this);
	}
});

$("#field-org-phone").focusout(function(){
	var phone = $(this).val();
	var phoneExp = /^(\+91[\-\s]?)?[0]?(91)?[789]\d{9}$/;
	if (!phoneExp.test(phone)) {
		createError(this,'Please enter 10-digit phone number');
	}	
	else{
		removeError(this);
	}
});

$("#field-state").change(function(){
	 var stateList = document.getElementById('field-state');
	 if(stateList.value == ''){
		 createError(this,'select a valid State of your address');
	 }
	 createCityList(); 
  });

$("#field-org-nature").change(function(){
	var nature = $(this).val();
	if(nature=='none'){
		$("#field-org-others").parent().removeClass('opa-0');
	}
	else{
		$("#field-org-others").parent().addClass('opa-0');
	}
});

$("#field-poc-email").focusout(function(){
	var email = $(this).val();
	var emailExp = /^[^\s()<>@,;:\/]+@\w[\w\.-]+\.[a-z]{2,}$/i;
	if (!emailExp.test(email)) {
		createError(this,'The accepted format for email is : contact@example.com');
	}
	else{
		removeError(this);
	}
});

$("#field-poc-phone").focusout(function(){
	var phone = $(this).val();
	var phoneExp = /^(\+91[\-\s]?)?[0]?(91)?[789]\d{9}$/;
	if (!phoneExp.test(phone)) {
		createError(this,'Please enter 10-digit phone number');
	}
	else{
		removeError(this);
	}
});

$("body").on("keyup", "#field-participants", function (e) {
  var inputValue = $(this).val(); 
  var error_msg = '';
  //console.log(inputValue);
  if(isNaN(inputValue)){
	  error_msg = "Number of Participants should only contain numerical values.";
  }
  else{
	  removeError(this);
  }
  if(inputValue.length>3){
	  error_msg = "Max participants for a single session exceeded, try increasing the number of sessions.";
  }
  else{
	  removeError(this);
  }
  if(error_msg !==''){
	createError(this,error_msg);
  }
});

$("body").on("keyup", "#field-sessions", function (e) {
  var inputValue = $(this).val(); 
  var error_msg = '';
  //console.log(inputValue);
  if(isNaN(inputValue)){
	  error_msg = "Number of Sessions should only contain numerical values.";
  }
  else{
	  removeError(this);
  }
  if(inputValue.length>3){
	  error_msg = "Max number of sessions exceeded.";
  }
  else{
	  removeError(this);
  }
  if(error_msg !==''){
	createError(this,error_msg);
  }
});

$("body").on("keyup", "#field-head-count", function (e) {
  var inputValue = $(this).val(); 
  var error_msg = '';
  //console.log(inputValue);
  if(isNaN(inputValue)){
	  error_msg = "Head Count should only contain numerical values.";
  }
  else{
	  removeError(this);
  }
  if(inputValue.length>8){
	  error_msg = "Are you sure your company head count is more than 1 crore people? Please review.";
  }
  else{
	  removeError(this);
  }
  if(error_msg !==''){
	createError(this,error_msg);
  }
});


//----------------------------------------ON SUBMIT VALIDATIONS.............
  $('#inquiry-form').submit(function(e) {
    e.preventDefault();
	
	var nature = $('#field-org-nature').val();
	if( nature == 'none'){
		var others = $('#field-org-others').val();
		if(others == ''){
			createErrorAlt($('#field-org-others'),'Nature Of Business cannot be left blank!');
			alert('The field: "Nature Of Business" cannot be left blank!');
			return false;
		}
	}
    
    var f = $(this).find('.form-element'),
      ferror = false,
      emailExp = /^[^\s()<>@,;:\/]+@\w[\w\.-]+\.[a-z]{2,}$/i;

    f.children('input').each(function() { // run all inputs
     
      var i = $(this); // current input
      var rule = i.attr('data-rule');
	  
	  if(i.parent().hasClass('form-has-error')=='true'){
		  ferror = ierror = true;
	  }

      if (rule !== undefined) {
        var ierror = false; // error flag for current input
        var pos = rule.indexOf(':', 0);
        if (pos >= 0) {
          var exp = rule.substr(pos + 1, rule.length);
          rule = rule.substr(0, pos);
        } else {
          rule = rule.substr(pos + 1, rule.length);
        }

        switch (rule) {
          case 'required':
            if (i.val() === '') {
              ferror = ierror = true;
            }
            break;

          case 'minlen':
            if (i.val().length < parseInt(exp)) {
              ferror = ierror = true;
            }
            break;

          case 'email':
            if (!emailExp.test(i.val())) {
              ferror = ierror = true;
            }
            break;

          case 'checked':
            if (! i.is(':checked')) {
              ferror = ierror = true;
            }
            break;

          case 'regexp':
            exp = new RegExp(exp);
            if (!exp.test(i.val())) {
              ferror = ierror = true;
            }
            break;
        }
        i.next('.validate').html((ierror ? (i.attr('data-msg') !== undefined ? i.attr('data-msg') : 'wrong Input') : '')).show('blind');
      }
    });
    f.children('textarea').each(function() { // run all inputs

      var i = $(this); // current input
      var rule = i.attr('data-rule');

      if (rule !== undefined) {
        var ierror = false; // error flag for current input
        var pos = rule.indexOf(':', 0);
        if (pos >= 0) {
          var exp = rule.substr(pos + 1, rule.length);
          rule = rule.substr(0, pos);
        } else {
          rule = rule.substr(pos + 1, rule.length);
        }

        switch (rule) {
          case 'required':
            if (i.val() === '') {
              ferror = ierror = true;
            }
            break;

          case 'minlen':
            if (i.val().length < parseInt(exp)) {
              ferror = ierror = true;
            }
            break;
        }
        i.next('.validate').html((ierror ? (i.attr('data-msg') != undefined ? i.attr('data-msg') : 'wrong Input') : '')).show('blind');
		createErrorAlt(i,i.attr('data-msg'));
      }
    });
    if (ferror) return false;

    var this_form = $(this);
    var action = $(this).attr('action');

    if( ! action ) {
      this_form.find('.loading').slideUp();
      this_form.find('.error-message').slideDown().html('The form action property is not set!');
	  alert('Something went wrong. Please Refresh the page and re-submit the form.')
      return false;
    }
    
    this_form.find('.sent-message').slideUp();
    this_form.find('.error-message').slideUp();
    this_form.find('.loading').slideDown();

    // if ( $(this).data('recaptcha-site-key') ) {
      // var recaptcha_site_key = $(this).data('recaptcha-site-key');
      // grecaptcha.ready(function() {
        // grecaptcha.execute(recaptcha_site_key, {action: 'php_email_form_submit'}).then(function(token) {
          // php_email_form_submit(this_form,action,this_form.serialize() + '&recaptcha-response=' + token);
        // });
      // });
    // } else {
      // php_email_form_submit(this_form,action,this_form.serialize());
    // }
	
    php_email_form_submit(this_form,action,this_form.serialize());
    return true;
  });

  function php_email_form_submit(this_form, action, data) {
    $.ajax({
      type: "POST",
      url: action,
      data: data,
      timeout: 40000
    }).done( function(msg){
      if (msg.trim() == 'OK') {
		resetForm();
        alert("Your inquiry is SUCCESSFULLY submitted. Our Team will get back to you, shortly!");
      } else {
        if(!msg) {
          msg = 'Form submission failed and no error message returned from: ' + action + '<br>';
        }
        alert(msg);
      }
    }).fail( function(data){
      // console.log(data);
      var error_msg = "Something went WRONG! Help us improve, Send the following error message to : info@insukoon.com<br>";
      if(data.statusText || data.status) {
        error_msg += 'Status:';
        if(data.statusText) {
          error_msg += ' ' + data.statusText;
        }
        if(data.status) {
          error_msg += ' ' + data.status;
        }
        error_msg += '<br>';
      }
      if(data.responseText) {
        error_msg += data.responseText;
      }
      alert(error_msg);
    });
  }

})(jQuery);
