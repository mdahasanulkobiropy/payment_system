(function ($) {
    "use strict"

    /* Document on load functions */
    $(window).on('load', function () {
      $(".main__content__search-form").trigger("reset");
    });

    /* Bootstrap form validation function */
    (function() {
      window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
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

    /* Theme toggler functions */
    $(".theme-toggler").click(function(){
      $("html").toggleClass("dark-layout");
    });

    /* Document on ready functions */
    $(document).ready(function(){

      /* Click to reset addTaskForm functions */
      $("#addTaskButton").on("click", function(){
        $("#addTaskForm").trigger("reset");
      });

      /* Search And Sort List Filter functions */
      (function(){

        $("#task-search-control").on("keyup", function() {
          var taskSearchValue = $(this).val().toLowerCase();
          var noResultsFound = $(".main__content__no-results");
          if (taskSearchValue !== '') {
            $('.main__content__list__item').filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(taskSearchValue) > -1);
            });
            var tbl_row = $('.main__content__list__item:visible').length; //here tbl_test is table name

            //Check if table has row or not
            if (tbl_row == 0) {
              if (!$(noResultsFound).hasClass('show')) {
                $(noResultsFound).addClass('show');
              }
            } else {
              $(noResultsFound).removeClass('show');
            }
          } else {
            // If filter box is empty
            $('.main__content__list__item').show();
            if ($(noResultsFound).hasClass('show')) {
              $(noResultsFound).removeClass('show');
            }
          }
        });

        function sortFilter(sortBy) {
          $(".main__content__body")
            .find('.main__content__list__item')
            .sort(function(a, b) {
              if(sortBy == "A-Z"){
                return $(b).find('.main__content__list__item__content__title').text().toUpperCase() < $(a).find('.main__content__list__item__content__title').text().toUpperCase() ? 1 : -1;
              }
              else if(sortBy == "Z-A"){
                return $(b).find('.main__content__list__item__content__title').text().toUpperCase() > $(a).find('.main__content__list__item__content__title').text().toUpperCase() ? 1 : -1;
              }
            })
            .appendTo($(".main__content__list"));
        }

        $("#sortA-Z").on("click", function(){
          sortFilter("A-Z");
        });

        $("#sortZ-A").on("click", function(){
          sortFilter("Z-A");
        });

      })();


      /* Aside toggler functions */
      $(".main__aside__toggler").on("click", function(){
        $(".main__aside--closer").fadeIn(200);
        $(".main__aside").addClass("show");
      });
      $(".main__aside--closer").on("click", function(){
        $(this).fadeOut(200);
        $(".main__aside").removeClass("show");
      });

      /* Dropdown position fix function */
      $('.custom-dropdown .dropdown-toggle').attr("data-offset", `${($('.custom-dropdown .dropdown-menu').outerWidth() / 1.2) * -1}, 0`);

      /* Feather icon function */
      feather.replace({width: '1em', height: '1em'});



      (function(){

        var taskAssignSelect = $('.task-assigned');

        // Task Assign Select2
        if (taskAssignSelect.length) {
          // Assign task
          function assignTask(option) {
            if (!option.id) {
              return option.text;
            }
            var $person =
              '<div class="media align-items-center">' +
              '<img class="media__image d-block rounded-circle mr-50" src="' +
              $(option.element).data('img') +
              '" height="26" width="26" alt="' +
              option.text +
              '">' +
              '<div class="media-body"><p class="media-body__text mb-0">' +
              option.text +
              '</p></div></div>';

            return $person;
          };
          taskAssignSelect.each(function(){
            $(this).wrap('<div class="position-relative"></div>');
            $(this).select2({
              multiple: true,
              placeholder: 'Unassigned',
              dropdownParent: $(this).parent(),
              templateResult: assignTask,
              templateSelection: assignTask,
              escapeMarkup: function (es) {
                return es;
              }
            });
          })
        };
      })();

      $(".task-tags").each(function(){
        $(this).select2({
          multiple: true,
        });
      })

      document.querySelectorAll('input[type=date]').forEach(e => {
        flatpickr(e, {
            minDate: e.getAttribute('min'),
            maxDate: e.getAttribute('max'),
            defaultDate: e.getAttribute('value'),
            altFormat: 'F j, Y',
            dateFormat: 'Y-m-d',
            altInput: true,
        });
      });

      $('.custom-scrollbar').each(function(){ const ps = new PerfectScrollbar($(this)[0]); });

      $(function () {
				$('[data-toggle="tooltip"]').tooltip()
			});

    });

})(jQuery);
