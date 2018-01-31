
//Function for getting places from db to list
function getPlaces() {
  $.getJSON("/places", function(result){
    console.log(result);
    var items = [];
    $.each(result, function(i, field){
      items.push("<li class='list-group-item justify-content-between place'> <span class='glyphicon glyphicon-map-marker'></span> " + result[i].title + "<input type='hidden' name='placeid' value='" + result[i].id +"'/> <input type='hidden' name='lat' value='" + result[i].lat +"'/> <input type='hidden' name='lng' value='" + result[i].lng +"'/> <button type='button' class='btn btn-basic btn-md delete'><span class='glyphicon glyphicon-trash'></span></button> <br> <span class='glyphicon glyphicon-time'></span> " + result[i].open_hours + "<br /> <span class='glyphicon glyphicon-info-sign'></span> " + result[i].description + "<br /> </li>");
    });

    $( "<div>", {
      "class": "list",
      html: items.join( "" )
    }).appendTo( ".allPlaces" );
  });
}
// Function for getting keywords from db to list
function getKeywords() {
  $.getJSON("/keywords", function(result){
    console.log(result);
    var items = [];
    $.each(result, function(i, field){
      items.push("<li class='list-group-item justify-content-between place'> <span class='glyphicon glyphicon-tag'></span> " + result[i].label + "</li>");
    });

    $( "<div>", {
      "class": "keyword",
      html: items.join( "" )
    }).appendTo( ".allKeywords" );
  });
}
// When the page is loaded
$(document).ready(function()
{
  // Get places & keywords to list
  getPlaces();
  getKeywords();

  // Get token
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  // Hide divs "Form" and "Message" when page is ready
  $("#form").hide();
  $("#message").hide();

});
/*
* Submit form
*
* Ajax for adding new place
*/
$(".submit").click(function(e){
  e.preventDefault();

  // Lets make variables to all inputs, to get values
  var title = $("input[name=title]").val();
  var description = $("input[name=description]").val();
  var latlng = marker.getPosition();
  var lat = latlng.lat()
  var lng = latlng.lng()
  var open_hours = $("input[name=open_hours]").val();
  var favorite = $("input:checked").val();
  var form = $(this).closest('form');
  $.ajax({
    type:'POST',
    url:'/create',
    data:{title:title, description:description, lat:lat, lng:lng, open_hours:open_hours, favorite:favorite},
    success:function(data){
      // Close form
      infowindow.close();
      // Show message
      $("#message").show();
      messagewindow.open(map, marker);
      // Find form and set values empty except radio values
      form.find('input:not(:radio)').val('');
      // Set radio buttons not checked
      form.find('input:radio').prop('checked', false);
      // Empty place list
      $( ".list" ).empty();
      // Load list again
      getPlaces();
    }
  });
});

$(".addKeyword").click(function(e){
  e.preventDefault();
  // Lets make variables to all inputs, to get values
  var label = $("input[name=label]").val();
  $.ajax({
    type:'POST',
    url:'/keyword/create',
    data: {label:label},
    success:function(data){
      $('#addKeywordModal').modal('toggle');
      $( ".keyword" ).empty();
      getKeywords();
    },
    error:(function(data)
    {
      console.log(data);
      // Show alert, if something went wrong
      alert('Nyt joku meni pieleen');
    })
  });
});

// $(document).on('click', '.update', function()
// {
//   var currentPlace = $(this).closest('.modal-body');
//   console.log("Haluat päivittää tiedot");
//   var id = $("input[name=id]").val();
//   var title = $("input[name=title]").val();
//   var description = $("input[name=description]").val();
//   var lat = $("input[name=lat]").val();
//   var lng = $("input[name=lng]").val();
//   var open_hours = $("input[name=open_hours]").val();
//   var favorite = $("input:checked").val();
//   var token = $('input[name=token]').val();
//
//   $.ajax({
//     url: '/update',
//     data: {_token: token, id:id, title: title, description: description, open_hours: open_hours, lat: lat, lng: lng, favorite: favorite},
//     type: 'POST',
//     cache: false,
//     dataType: 'html',
//     success:function(data)
//     {
//       console.log("Päivitetty");
//       // $( ".list" ).empty();
//       // // Load list again
//       // getPlaces();
//       // initMap();
//       //window.location.href=window.location.href;
//       //  $('#favorite').removeClass('glyphicon glyphicon-star-empty').addClass('glyphicon glyphicon-star');
//
//      },
//     error:(function()
//     {
//       // Show alert, if something went wrong
//       alert('Nyt joku meni pieleen');
//     })
//  });
// });


//Function for deletig place (one at time)
$(document).on('click', '.delete', function()
{
  var currentDiv = $(this).closest('.list-group');
  var currentPlace = $(this).closest('.place');
  var id = currentPlace.find('input[name=placeid]').val();
  $.ajax({
    url: '/remove/'+id,
    type: 'DELETE',
    cache: false,
    dataType: 'html',
    success:function(data)
    {
      currentPlace.remove();
      initMap();

    },
    error:(function()
    {
      // Show alert, if something else went wrong
      alert('Hmm.. joku meni nyt pieleen');
    })
  });
});

// Live search for title
$('#search').on('keyup',function(){
  var value=$(this).val();
  $.ajax({
    type : 'get',
    url : '/search',
    data:{search: value},

    success:function(data){
      $('tbody').html(data);
    }
  });
})

// Variables for map
var map;
var marker;
var infowindow;
var messagewindow;
// Initializing map
function initMap() {
  var area = {lat: 60.187897, lng: 24.875730};
  map = new google.maps.Map(document.getElementById('map'), {
    center: area,
    zoom: 12
  });
  // Create infowindow for adding new places
  infowindow = new google.maps.InfoWindow({
    content: document.getElementById('form'),
  });
  // Create messagewindow for sending success info when new place has been added
  messagewindow = new google.maps.InfoWindow({
    content: document.getElementById('message')
  });
  // Listener for map clicks
  google.maps.event.addListener(map, 'click', function(event) {
    marker = new google.maps.Marker({
      position: event.latLng,
      map: map

    });
    // When map is clicked, show add form
    $("#form").show();
    infowindow.open(map, marker);

  });
  // Ajax for showing places in the map
  $.ajax({
    url:'/places',
    dataType: "json",
    success: function(data){
      $.each(data, function(key, data) {
        // Get datas from json, so we can use them futher
        var title = data.title;
        var open_hours = data.open_hours;
        var description = data.description;
        var mylatlng = new google.maps.LatLng(data.lat, data.lng);
        // Creating a marker and putting it on the map
        var marker = new google.maps.Marker({
          position: mylatlng,
        });
        // Create infowindow for existing place
        var existingwindow = new google.maps.InfoWindow;
        marker.setMap(map);
        var existingwincontent = document.createElement('div');
        var strong = document.createElement('strong');
        strong.textContent = title
        existingwincontent.appendChild(strong);
        existingwincontent.appendChild(document.createElement('br'));
        var text = document.createElement('text');
        text.textContent = open_hours
        existingwincontent.appendChild(text);
        existingwincontent.appendChild(document.createElement('br'));
        var des = document.createElement('des');
        des.textContent = description
        existingwincontent.appendChild(des);
        // When marker is clicked, show created infowindow
        marker.addListener('click', function() {
          existingwindow.setContent(existingwincontent);
          existingwindow.open(map, marker);
        });
      });
    }
  });

}
