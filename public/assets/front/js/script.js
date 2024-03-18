let items = document.querySelectorAll('#featureContainer .carousel .carousel-item');
items.forEach((el) => {
    const minPerSlide = 4
    let next = el.nextElementSibling
    for (var i = 1; i < minPerSlide; i++) {
        if (!next) {
            // wrap carousel by using first child
            next = items[0]
        }
        let cloneChild = next.cloneNode(true)
        el.appendChild(cloneChild.children[0])
        next = next.nextElementSibling
    }
})
$(document).ready(function() {
    $('#featureCarousel').carousel({ interval: false });
    $('#featureCarousel').carousel('pause');
});
$('#searchButton').on('click',function(){
    console.log('search button pressed');
    var search=$('#searchPost').val().trim();
    if(search.length>1){
        window.location.href = base_url+"/search/"+search;
    }
    else{
        alert('please enter atleast 2 charactors to search posts');
    }
});