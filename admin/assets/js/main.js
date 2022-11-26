/*
* @Author: SUPERMAN
* @Date:   2022-09-20 17:15:24
* @Last Modified by:   SUPERMAN
* @Last Modified time: 2022-09-20 17:17:00
*/

// Form Validation js
(function() {
    'use strict';
    window.addEventListener('load', function() {
        var forms = document.getElementsByClassName('form_validation');
        var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
        });
    }, false);
})();