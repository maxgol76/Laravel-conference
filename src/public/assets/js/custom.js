/*
 jQuery My Custom
 */


$(document).ready(function () {

    $(".checking").change(function () {
        //alert ('asasdas');
        var strId = $(this).attr('id');
        var idMember = strId.substring(6);

        var hide;

        if (this.checked) {
            hide = 1;
        } else {
            hide = 0;
        }

        $.ajax({
            url: "/admin/hidden",
            type: 'POST',
            data: {id:idMember, user_hidden:hide},
            dataType: "json",

            success: function (resultOk) {
                if ( resultOk == true ) {
                    $('#ModalInfoHidden').modal('show');

                    setTimeout(function () {
                        $('#ModalInfoHidden').modal('hide');
                    }, 1200);
                }
            }
        });

    });


    if ($("#form-registr").length) {   // if first form exist - second form hide
        $('#form-registr2').fadeOut();
    } else {
        $('#form-registr2').fadeIn();
    }

    SelectLoadCountry();

    $("#form-registr").submit(function () {

        $('.form-group').each(function () {
            $(this).removeClass('has-error');
            $(this).children("span").html('');
        });

        var form_data = $('#form-registr').serialize();

        $.ajax({
            url: "/registrat/validat",
            type: 'POST',
            data: form_data,
            dataType: "json",

            success: function (data) {

                if (data.resultOk) {
                    var msg = "<div class='alert alert-success text-center'>Registration has been successfully!</div>";
                    $('#alert-msg').html(msg);
                    members = parseInt($('#count-members').text());
                    $('#count-members').text(++members);

                    $("#btnsignup").attr('disabled', true);
                    $('#form-registr').delay(2000).fadeOut(500);
                    $('#form-registr2').delay(2500).fadeIn();
                } else {
                    $.each(data.msgErrorInput, function (inputName, msg) {
                        $('#' + inputName).addClass('has-error');
                        $('#error-' + inputName).css('color', 'red').html(msg);
                    });

                    if (data.msgError)
                        $('#alert-msg').html("<div class='alert alert-danger'>" + data.msgError + "</div>");
                }
            }
        });
        return false;
    });


    $(function () {
        $('#form-registr2').on('submit', function (e) {
            e.preventDefault();
            var $that = $(this),
                formData = new FormData($that.get(0));
            $("#btnsignup2").attr('disabled', true);

            $.ajax({
                url: $that.attr('action'),
                type: $that.attr('method'),
                contentType: false,
                processData: false,
                data: formData,

                success: function (msg) {
                    $("#btnsignup2").attr('disabled', false);
                    $('#alert-msg-form2').html(msg);

                    if (msg.indexOf('success') != -1) {
                        $("#btnsignup2").attr('disabled', true);
                        $('#form-registr2').delay(2000).fadeOut(500);
                        $('#soc-icon').delay(2500).fadeIn();
                    }
                }
            });
        });
    });


    $('#datetimepicker1').datetimepicker({
        pickTime: false,
        format: 'YYYY-MM-DD',
        maxDate: new Date()  /* limit to the current date */
    });


    $("#phone").mask("+1 (999) 999-9999");

    Share = {

        facebook: function (purl, ptitle, pimg, text) {
            url = 'http://www.facebook.com/sharer.php?s=100';
            url += '&p[title]=' + encodeURIComponent(ptitle);
            url += '&p[summary]=' + encodeURIComponent(text);
            url += '&p[url]=' + encodeURIComponent(purl);
            url += '&p[images][0]=' + encodeURIComponent(pimg);
            Share.popup(url);
        },

        twitter: function (purl, ptitle) {
            url = 'http://twitter.com/share?';
            url += 'text=' + encodeURIComponent(ptitle);
            url += '&url=' + encodeURIComponent(purl);
            url += '&counturl=' + encodeURIComponent(purl);
            Share.popup(url);
        },

        google: function (purl) {
            url = 'https://plus.google.com/share?url=' + purl;
            Share.popup(url);
        },

        popup: function (url) {
            window.open(url, '', 'toolbar=0,status=0,width=626,height=436,left=1200px');
        }
    };

    google.maps.event.addDomListener(window, 'load', initialize);


    $("#google-plus").click(function () {
        var m_url = $(this).attr("name");

        Share.google(m_url);
    });

    $("#twitter").click(function () {
        var m_title = $(this).attr("title");
        var m_url = $(this).attr("name");

        Share.twitter(m_url, m_title);
    });

    $("#faceb").click(function () {
        var m_url = $(this).attr("name");

        Share.facebook(m_url, 'Conference registration', '', 'Conference registration site');
    });


   /* document.getElementById("uploadBtn").onchange = function () {
        document.getElementById("uploadFile").value = this.value;
        $("#del-photo").fadeIn();
    };*/


    $("#uploadBtn").change(function () {
        document.getElementById("uploadFile").value = this.value;
        $("#del-photo").fadeIn();
    });



    $("#del-photo").click(function () {
        document.getElementById("uploadFile").value = '';
    });


    $('input[type=file]').change(function () {
        var file = this.files[0];
        /*alert("Size file: " + file.size + " B");*/
    });


});

function SelectLoadCountry() {
    var countries_arr = ["Angola", "Argentina", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Belgium", "Benin", "Bolivia", "Bonaire", "Bosnia - Herzegovina", "Botswana", "Brazil", "Brunei", "Bulgaria", "Cambodia", "Cameroon", "Canada", "Chile", "China(Fuzhou)", "China(Shanghai)", "China(Zhongshan)", "Colombia", "Costa Rica", "Croatia", "Curacao", "Cyprus", "Czech Republic", "Democratic Republic of Congo", "Denmark", "East Africa", "Ecuador", "El Salvador", "El Salvador - San Miguel", "Estonia", "Fiji", "Finland", "France", "Gabon", "Germany", "Ghana", "Great Britain", "Greece", "Guadaloupe", "Guatemala", "Honduras", "Honduras - Tegucigalpa", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Ireland", "Israel", "Italy", "Ivory Coast", "Japan", "Kazakhstan", "Korea", "Kosovo", "Kuwait", "Latvia", "Lesotho", "Lithuania", "Luxembourg", "Macau", "Macedonia", "Malaysia", "Martinique", "Mauritania", "Mexico", "Moldova", "Namibia", "Netherlands", "New Zealand", "Nicaragua", "Nigeria", "Northern Ireland", "Norway", "Panama", "Paraguay", "Peru", "Philippines", "Poland", "Portugal", "Puerto Rico", "Qatar", "Republic of Congo", "Reunion Islands", "Romania", "Russia", "Rwanda", "Saba", "Samoa", "Saudi Arabia", "Senegal", "Serbia & Montenegro, Singapore", "Slovak Republic", "Slovenia", "South Africa", "Spain", "St.Eustatius", "St.Maarten", "Suriname", "Swaziland", "Sweden", "Switzerland", "Taiwan", "Tanzania", "Thailand", "Togo", "Turkey", "Uganda", "Ukraine", "United Arab Emirates", "United States", "Uruguay", "Venezuela", "Vietnam"];

    for (var k = 0; k < countries_arr.length; k++) {
        $('#country').append('<option>' + countries_arr[k] + '</option>');
    }
}


var map;
var position = new google.maps.LatLng(34.1013674, -118.3458517);

function initialize() {
    var mapOptions = {
        zoom: 15,
        center: position
    };
    map = new google.maps.Map(document.getElementById('map'),
        mapOptions);

    var contentString = '<div><h3>7060 Hollywood Blvd, Los Angeles, CA</h3></div>';
    var infowindow = new google.maps.InfoWindow({
        content: contentString
    });

    var marker = new google.maps.Marker({
        position: position,
        map: map,
        title: "7060 Hollywood Blvd, Los Angeles, CA"
    });

    infowindow.open(map, marker);

}