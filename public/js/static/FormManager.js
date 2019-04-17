"use strict";

var Site = Site || {};
Site.FormManager = function() {
    var self = this;

    var header = null;
    var form = null;
    var requestForm = null;
    var successMessage = null;
    var splitText = null;
    var nameInput = null;
    var companyInput = null;
    var countryInput = null;
    var emailInput = null;
    var needsInput = null;
    var errorMessage = null;
    var inputs = [];

    this.requestButton = null;
    this.formSubmitSignal = new BK.Signal();

    this.init = function() {
        header = document.querySelector('.topic-form .animated-text');
        form = document.getElementById("form-section");
        requestForm = document.getElementById("request-form");
        this.requestButton = document.getElementById("request");
        this.requestButton.span = this.requestButton.getElementsByTagName("span")[0];
        successMessage = document.getElementById("success-message");
        nameInput = document.getElementById("NAME");
        companyInput = document.getElementById("COMPANY");
        countryInput = document.getElementById("COUNTRY");
        emailInput = document.getElementById("EMAIL");
        needsInput = document.getElementById("NEEDS");
        errorMessage = document.getElementById("error-message");
        inputs.push(nameInput, companyInput, countryInput, emailInput, needsInput);

        var inputBlocks = document.getElementsByClassName('input-block');
        for (var i = 0; i < inputBlocks.length; i++) {
            var input = inputBlocks[i].getElementsByTagName('input')[0];

            input.addEventListener('focus', function(ev) {
                ev.stopPropagation();
                ev.preventDefault();
                ev.target.parentElement.classList.add("filled");
            });

            input.addEventListener('blur', function(ev) {
                ev.stopPropagation();
                ev.preventDefault();
                if(ev.target.value == "" || ev.target.value == null) {
                    // it's empty
                    ev.target.parentElement.classList.remove("filled")
                }
            });
        }

        var textArea = document.getElementById('NEEDS');
        textArea.addEventListener("focus", function(ev) {
            ev.stopPropagation();
            ev.preventDefault();
            ev.target.parentElement.classList.add("filled")
        });

        textArea.addEventListener('blur', function(ev) {
            ev.stopPropagation()
            ev.preventDefault();
            if(ev.target.value == "" || ev.target.value == null) {
                // it's empty
                ev.target.parentElement.classList.remove("filled")
            }
        });

        if (Site.isDesktop) {
            successMessage.style.visibility = "hidden";
            splitText = new SplitText(successMessage, {type:"chars"});
            splitText.split({type:"chars"});
        }
    };

    this.showForm = function(section) {
        var lang = document.querySelector('.languages-form__field');
        var langVal = lang.value;

        if (section == 4) {
            form.classList.add("active");

            self.requestButton.classList.add("submit");

            if (langVal === 'ru') {
                self.requestButton.span.innerHTML = "Отправить";
            } else {
                self.requestButton.span.innerHTML = "Send";
            }
        } else {
            form.classList.remove("active");
            self.requestButton.classList.remove("submit");

            if (langVal === 'ru') {
                self.requestButton.span.innerHTML = "Задайте вопрос"
            } else {
                self.requestButton.span.innerHTML = "Ask a question";
            }
        }
    };

    this.requestFormSubmit = function() {
        var routeID = "";
        var companyID = "entry.1226040904";
        var emailID = "entry.755399294";
        var needsID = "entry.348093703";

        var baseURL = '/sendMail';
        var submitRef = '&submit=6643460394068581655';
        var submitURL =
            // (
            baseURL;
            // + routeID + "?name=" + nameInput.value + "&country=" + companyID + "=" + companyInput.value + "&" + emailID + "=" + String(emailInput.value)
            // + "&" + needsID + "=" + needsInput.value + submitRef);

        this.inputsRemoveClass("error");
        this.errorCheck();

        // if (nameInput.value != "" && nameInput.value != null && companyInput.value != "" && companyInput.value != null && String(emailInput.value) != "" && String(emailInput.value) != null && needsInput.value != "" && needsInput.value != null) {
        //     requestForm.action = submitURL;
        //     requestForm.submit();

        //     this.resetForm();
        //     this.successAnimate();

        //     // TODO: signal
        //     this.formSubmitSignal.fire();
        // }
        if (nameInput.value != "" && nameInput.value != null && countryInput.value != "" && countryInput.value != null) {
            requestForm.action = submitURL;
            requestForm.submit();

            this.resetForm();
            this.successAnimate();

            // TODO: signal
            this.formSubmitSignal.fire();
        }
    };

    this.errorCheck = function() {
        for (i=0; i<inputs.length; i++) {
            if (inputs[i].hasAttribute('required') && String(inputs[i].value) == "" || String(inputs[i].value) == null) {
                inputs[i].parentElement.classList.add("error");
            }

            if (inputs[i].parentElement.classList.contains("error")) {
                errorMessage.classList.add("active");
            } else {
                errorMessage.classList.remove("active");
            }
        }
    };

    this.resetForm = function() {
        requestForm.reset();
        this.inputsRemoveClass("filled");
    };

    this.successAnimate = function() {
        // Animate form and requestButton out and success message in
        header.classList.add('hidden');
        form.classList.remove("active");
        this.requestButton.classList.add("submitted");
        successMessage.classList.add("in");
        successMessage.style.visibility = "";
        var t = new TimelineLite();
        t.staggerFrom(splitText.chars, 0.7, {
            opacity: 0, rotationX: 90, delay: 0.1, transformOrigin: "0% 50% 0%", ease: Expo.easeOut
        }, 0.02);
        form.classList.add("submitted");
        document.querySelector('.callback').classList.add("showed");;
    };

    this.inputsRemoveClass = function(className) {
        for (i=0; i<inputs.length; i++) {
            inputs[i].parentElement.classList.remove(className);
        }
    }
}
