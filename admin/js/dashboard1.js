    //Modal
function mapModal(marker){
    data = marker.data;

    $("#map").hide(100)

    $("#sysdet").show(100);
    $("#sysname").text(data.name+" - "+data.locationName);
    // $('#mapDetailsModal').modal('toggle')
}
function fillStats(data,  type){
    //Function for filling data in model as clicked
    $("#mapDetailsModal [data-type*='"+type+"']").text(data);
}
function rand(min, max) {
  min = Math.ceil(min);
  max = Math.floor(max);
  return Math.floor(Math.random() * (max - min + 1)) + min; //The maximum is inclusive and the minimum is inclusive 
}
var ip = "pipe.php?action="
$("#closePipe").on('click', function(){
    $.get(ip+"Water pumpon", function(data, status){
        log(data);
    });
})
$("#openPipe").on('click', function(){
    $.get(ip+"Water pumpoff", function(data, status){
        log(data);
    });
})
