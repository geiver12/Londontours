function userEdit(idUser){

    var form_data = new FormData();
    form_data.append("idUser", idUser);

    $.ajax({
        type: 'POST',
        processData: false,
        contentType: false,
        cache: false,
        url: '../php/functionPost.php',
        data: form_data,
        beforeSend: function () {
            
        },
        success: function(msg) {
            if(msg != 'nok'){
                //$('.msgChangePass').html('<div class="alert alert-success alert-dismissable col-md-10 col-md-offset-1 "><button type="button" class="close" data-dismiss="alert"><strong>&times;</strong></button>Registros actualizados <strong>exitosamente</strong>.</div>');
                $("#userEditModal").load(" #userEditModal");
            }else{
                //$('.msgChangePass').html('<div class="alert alert-danger alert-dismissable col-md-10 col-md-offset-1 "><button type="button" class="close" data-dismiss="alert"><strong>&times;</strong></button><strong>¡Error!</strong> Ocurrio un problema al guardar.</div>');
                console.log('Error Edit User: ' +msg);
            }
                
        },
        error: function(jqXHR,error, errorThrown) {  
           if(jqXHR.status && jqXHR.status==400){
                console.log(jqXHR); 
           }else{
               console.log("Something went wrong");
            }
        }

    });

}

function userUpdt(idUser){

    var form_data = new FormData(); 
    var email = $('#email').val();
    var address = $('#address').val(); 
    var phone = $('#phone').val();
    var name = $('#name').val();
    var city = $('#city').val();
    var postcode = $('#postcode').val(); 
    var password = $('#password').val();
    var passwordC = $('#passwordC').val();

    form_data.append("email", email);    
    form_data.append("address", address);   
    form_data.append("phone", phone);   
    form_data.append("city", city);
    form_data.append("name", name);       
    form_data.append("postcode", postcode);
    form_data.append("password", password);
    form_data.append("passwordC", passwordC); 
    form_data.append("idUserU", idUser);

    $.ajax({
        type: 'POST',
        processData: false,
        contentType: false,
        cache: false,
        url: '../php/functionPost.php',
        data: form_data,
        beforeSend: function () {               
        },
        success: function(msg) {
            if(msg == 'ok'){
                $('.pfleModal').modal('toggle');
                $("#data-table-basic").load(" #data-table-basic");
                $('.userEditModal').modal('toggle');
                console.log(msg);
            }else{
                //$('.msgChangePass').html('<div class="alert alert-danger alert-dismissable col-md-10 col-md-offset-1 "><button type="button" class="close" data-dismiss="alert"><strong>&times;</strong></button><strong>¡Error!</strong> Ocurrio un problema al guardar.</div>');
                console.log('Error Update User: ' +msg);
            }
                
        }
    });
}

function userDel(idUser){

    var form_data = new FormData();    
    form_data.append("idUserD", idUser);    

    $.ajax({
        type: 'POST',
        processData: false,
        contentType: false,
        cache: false,
        url: '../php/functionPost.php',
        data: form_data,
        beforeSend: function () {              
        },
       success: function(msg) {
            if(msg == 'ok'){
                $("#data-table-basic").load(" #data-table-basic");
            }else{
                console.log('Error Delete User: ' +msg);
            }
                
        }
    });

}

//Bookings
function bookEdit(idBook){
    var form_data = new FormData();

    form_data.append("idBook", idBook);

    $.ajax({
        type: 'POST',
        processData: false,
        contentType: false,
        cache: false,
        url: '../php/functionPost.php',
        data: form_data,
        beforeSend: function () {
            
        },
        success: function(msg) {
            if(msg != 'nok'){
                $("#bookEditModal").load(" #bookEditModal");
            }else{
                console.log('Error Edit Booking: ' +msg);
            }
                
        },
        error: function(jqXHR,error, errorThrown) {  
           if(jqXHR.status && jqXHR.status==400){
                console.log(jqXHR); 
           }else{
               console.log("Something went wrong");
            }
        }

    });

}

function bookUpdt(idBook){

    var form_data = new FormData(); 
    var date = $('#datet').val();
    var state = $('#state').val();  
    var user = $('#user').val();
    var tour = $('#tour').val(); 
    var tickets = $('#tickets').val();

    form_data.append("date", date);
    form_data.append("state", state);
    form_data.append("user", user);    
    form_data.append("tour", tour);
    form_data.append("tickets", tickets);    
    form_data.append("idBookU", idBook);

    $.ajax({
        type: 'POST',
        processData: false,
        contentType: false,
        cache: false,
        url: '../php/functionPost.php',
        data: form_data,
        beforeSend: function () {               
        },
        success: function(msg) {
            if(msg == 'ok'){
                $("#data-table-basic").load(" #data-table-basic");
                $('.bookEditModal').modal('toggle');
            }else{
                //$('.msgChangePass').html('<div class="alert alert-danger alert-dismissable col-md-10 col-md-offset-1 "><button type="button" class="close" data-dismiss="alert"><strong>&times;</strong></button><strong>¡Error!</strong> Ocurrio un problema al guardar.</div>');
                console.log('Error Update Booking: ' +msg);
            }
                
        }
    });
}

function bookCancel(idBook){

    var form_data = new FormData();

    form_data.append("idBookC", idBook);

    $.ajax({
        type: 'POST',
        processData: false,
        contentType: false,
        cache: false,
        url: '../php/functionPost.php',
        data: form_data,
        beforeSend: function () {               
        },
        success: function(msg) {
            if(msg == 'ok'){
                $("#data-table-basic").load(" #data-table-basic");
                //$('.bookEditModal').modal('toggle');
            }else{
                //$('.msgChangePass').html('<div class="alert alert-danger alert-dismissable col-md-10 col-md-offset-1 "><button type="button" class="close" data-dismiss="alert"><strong>&times;</strong></button><strong>¡Error!</strong> Ocurrio un problema al guardar.</div>');
                console.log('Error Update Booking: ' +msg);
            }
                
        }
    });
}

function bookDel(idBook){

    var form_data = new FormData();    
    form_data.append("idBookD", idBook);    

    $.ajax({
        type: 'POST',
        processData: false,
        contentType: false,
        cache: false,
        url: '../php/functionPost.php',
        data: form_data,
        beforeSend: function () {              
        },
       success: function(msg) {
            if(msg == 'ok'){
                $("#data-table-basic").load(" #data-table-basic");
            }else{
                console.log('Error Delete Booking: ' +msg);
            }
                
        }
    });

}

//Commentary
function ctryAdd(){

    var form_data = new FormData(); 
    var nameMsg = $('#nameMsg').val();
    var emailMsg = $('#emailMsg').val(); 
    var textMsg = $('#textMsg').val(); 

    form_data.append("nameMsg", nameMsg);    
    form_data.append("emailMsg", emailMsg);
    form_data.append("textMsg", textMsg);

    $.ajax({
        type: 'POST',
        processData: false,
        contentType: false,
        cache: false,
        url: 'php/functionPost.php',
        data: form_data,
        beforeSend: function () {               
        },
        success: function(msg) {
            if(msg == 'ok'){
                $('.ctryModal').modal('toggle');
                $('#nameMsg').val('');
                $('#emailMsg').val('');
                $('#textMsg').val('');
            }else{
                console.log('Error Create Commentary: ' +msg);
            }
                
        }
    });
}


function ctryDel(idCtry){

    var form_data = new FormData();    
    form_data.append("idCtryD", idCtry);    

    $.ajax({
        type: 'POST',
        processData: false,
        contentType: false,
        cache: false,
        url: '../php/functionPost.php',
        data: form_data,
        beforeSend: function () {              
        },
       success: function(msg) {
            if(msg == 'ok'){
                $("#data-table-basic").load(" #data-table-basic");
            }else{
                console.log('Error Delete Commentary: ' +msg);
            }
                
        }
    });

}

//Tours
function tourCreate(){

    var form_data = new FormData(); 
    var date = $('#date').val();
    var name = $('#name').val(); 
    var image = $('#image').val();
    var price = $('#price').val();
    var itinerary = $('#itinerary').val();
    var duration = $('#duration').val(); 
    var description = $('#description').val();

    form_data.append("date", date);    
    form_data.append("name", name);   
    form_data.append("image", image);   
    form_data.append("price", price);
    form_data.append("itinerary", itinerary);       
    form_data.append("duration", duration);
    form_data.append("description", description);


    $.ajax({
        type: 'POST',
        processData: false,
        contentType: false,
        cache: false,
        url: '../php/functionPost.php',
        data: form_data,
        beforeSend: function () {               
        },
        success: function(msg) {
            if(msg == 'ok'){
                $("#data-table-basic").load(" #data-table-basic");
                $('.newTour').modal('toggle');
                
            }else{                
                console.log('Error New Tour: ' +msg);
            }
                
        }
    });
}

function tourEdit(idTour){
    var form_data = new FormData();
    
    form_data.append("idTour", idTour);

    $.ajax({
        type: 'POST',
        processData: false,
        contentType: false,
        cache: false,
        url: '../php/functionPost.php',
        data: form_data,
        beforeSend: function () {
            
        },
        success: function(msg) {
            if(msg != 'nok'){
                $("#tourEditModal").load("#tourEditModal");
            }else{
                console.log('Error Edit Tour: ' +msg);
            }
                
        },
        error: function(jqXHR,error, errorThrown) {  
           if(jqXHR.status && jqXHR.status==400){
                console.log(jqXHR); 
           }else{
               console.log("Something went wrong");
            }
        }

    });

}

function tourUpdt(idTour){

    var form_data = new FormData(); 
    var date = $('#dateE').val();
    var name = $('#nameE').val(); 
    var image = $('#imageE').prop('files')[0];
    var price = $('#priceE').val();
    var itinerary = $('#itineraryE').val();
    var duration = $('#durationE').val(); 
    var description = $('#descriptionE').val();
    
    form_data.append("date", date);    
    form_data.append("name", name);   
    form_data.append("image", image);   
    form_data.append("price", price);
    form_data.append("itinerary", itinerary);       
    form_data.append("duration", duration);
    form_data.append("description", description);
    form_data.append("idTourU", idTour);
     

    $.ajax({
        type: 'POST',
        processData: false,
        contentType: false,
        cache: false,
        url: '../php/functionPost.php',
        data: form_data,
        beforeSend: function () {               
        },
        success: function(msg) {
            if(msg == 'ok'){
                $('.tourEditModal').modal('toggle');
                $("#data-table-basic").load(" #data-table-basic");
            }else{
                //$('.msgChangePass').html('<div class="alert alert-danger alert-dismissable col-md-10 col-md-offset-1 "><button type="button" class="close" data-dismiss="alert"><strong>&times;</strong></button><strong>¡Error!</strong> Ocurrio un problema al guardar.</div>');
                console.log('Error Update Tour: ' +msg);
            }
                
        }
    });
}

function tourDel(idTourD){

    var form_data = new FormData();
    form_data.append("idTourD", idTourD);

    $.ajax({
        type: 'POST',
        processData: false,
        contentType: false,
        cache: false,
        url: '../php/functionPost.php',
        data: form_data,
        beforeSend: function () {
        },
       success: function(msg) {
            if(msg == 'ok'){
                $("#data-table-basic").load(" #data-table-basic");
            }else{
                console.log('Error Delete Tour: ' +msg);
            }

        }
    });

}