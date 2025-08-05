$(document).ready(function(){
    var sourceOfDrinkingWaterValue = $('#field-label-10').val();
    var beforeBurrowValue = $('#field-label-22').val();
    var balanceDietValue = $('#field-label-18').val();
    var sourceOfCreditValue = $('#field-label-23').val();

    if(sourceOfDrinkingWaterValue){
        $.ajax({
            type: "POST",
            url:  "/user/onChangeValueDefiner",
            data: 
                {sourceOfDrinkingWater:sourceOfDrinkingWaterValue},
             success: function(response) {
                if(response == "Yes"){
                    $("#lbl-source-of-drinking-water").show();
                    $("#field-label-11").show();
                 }
                 else{
                    $("#lbl-source-of-drinking-water").hide();
                    $("#field-label-11").hide();
                 }
            }
          });
    }
    else{
        $("#lbl-source-of-drinking-water").hide();
        $("#field-label-11").hide();
    }

    if(beforeBurrowValue){
        $.ajax({
            type: "POST",
            url:  "/user/onChangeValueDefiner",
            data: 
                {beforeBurrow:beforeBurrowValue},
             success: function(response) {
                if(response == "Yes"){
                    $("#lbl-before-burrow").show();
                    $("#field-label-23").show();
                 }
                 else{
                    $("#lbl-before-burrow").hide();
                    $("#field-label-23").hide();
                 }
            }
          });
    }
    else{
        $("#lbl-before-burrow").hide();
        $("#field-label-23").hide();
    }

    if(balanceDietValue){
        $.ajax({
            type: "POST",
            url:  "/user/onChangeValueDefiner",
            data:{balanceDiet:balanceDietValue},
             success: function(response) {
                if(response == "Yes"){
                    $("#lbl-no-balance-diet").show();
                    $("#field-label-19").show();
                 }
                 else{
                    $("#lbl-no-balance-diet").hide();
                    $("#field-label-19").hide();
                 }
            }
          });
    }
    else{
        $("#lbl-no-balance-diet").hide();
        $("#field-label-19").hide();
    }

    if(sourceOfCreditValue.length >0){
        $.ajax({
            type: "POST",
            url:  "/user/onChangeValueDefiner",
            data:{sourceOfCredit:sourceOfCreditValue},
             success: function(response) {
                if(response.includes("Formal") && !response.includes("Informal")){
                    $("#lbl-formal_barrow").show();
                    $("#field-label-25").show();

                    $("#lbl-status-burrowed-formal").show();
                    $("#field-label-27").show();

                    $("#lbl-repaid-formal").show();
                    $("#field-label-28").show();

                    $("#lbl-informal-barrow").hide();
                    $("#field-label-24").hide();

                    $("#lbl-rapid-status-informal").hide();
                    $("#field-label-26").hide();

                    $("#lbl-rapid-paid-informal").hide();
                    $("#field-label-29").hide();
                 }
                 else if(response.includes("Informal") && !response.includes("Formal")){
                    $("#lbl-informal-barrow").show();
                    $("#field-label-24").show();

                    $("#lbl-rapid-status-informal").show();
                    $("#field-label-26").show();

                    $("#lbl-rapid-paid-informal").show();
                    $("#field-label-29").show();

                    $("#lbl-formal_barrow").hide();
                    $("#field-label-25").hide();

                    $("#lbl-status-burrowed-formal").hide();
                    $("#field-label-27").hide();

                    $("#lbl-repaid-formal").hide();
                    $("#field-label-28").hide();
                 }
                 else if(response.includes("Informal") && response.includes("Formal")){
                    $("#lbl-informal-barrow").show();
                    $("#field-label-24").show();

                    $("#lbl-rapid-status-informal").show();
                    $("#field-label-26").show();

                    $("#lbl-rapid-paid-informal").show();
                    $("#field-label-29").show();

                    $("#lbl-formal_barrow").show();
                    $("#field-label-25").show();

                    $("#lbl-status-burrowed-formal").show();
                    $("#field-label-27").show();

                    $("#lbl-repaid-formal").show();
                    $("#field-label-28").show();
                 }
                 else{
                    $("#lbl-informal-barrow").hide();
                    $("#field-label-24").hide();

                    $("#lbl-rapid-status-informal").hide();
                    $("#field-label-26").hide();

                    $("#lbl-rapid-paid-informal").hide();
                    $("#field-label-29").hide();

                    $("#lbl-formal_barrow").hide();
                    $("#field-label-25").hide();

                    $("#lbl-status-burrowed-formal").hide();
                    $("#field-label-27").hide();

                    $("#lbl-repaid-formal").hide();
                    $("#field-label-28").hide();  
                 }
            }
          });
    }
    else{
        $("#lbl-formal_barrow").hide();
        $("#field-label-25").hide();

        $("#lbl-status-burrowed-formal").hide();
        $("#field-label-27").hide();

        $("#lbl-repaid-formal").hide();
        $("#field-label-28").hide();

        $("#lbl-informal-barrow").hide();
        $("#field-label-24").hide();

        $("#lbl-rapid-status-informal").hide();
        $("#field-label-26").hide();

        $("#lbl-rapid-paid-informal").hide();
        $("#field-label-29").hide();
    }

    

    $("#field-label-10").change(function(){
        $.ajax({
            type: "POST",
            url:  "/user/onChangeValueDefiner",
            data: {
                sourceOfDrinkingWater: $('#field-label-10').val(),
             },
             success: function(response) {
                if(response == "Yes"){
                    $("#lbl-source-of-drinking-water").show();
                    $("#field-label-11").show();
                 }
                 else{
                    $("#lbl-source-of-drinking-water").hide();
                    $("#field-label-11").hide();
                    $("#field-label-11").val("");
                 }
            }
          });
      });

      $("#field-label-22").change(function(){
        $.ajax({
            type: "POST",
            url:  "/user/onChangeValueDefiner",
            data: {
                beforeBurrow:$('#field-label-22').val()
             },
             success: function(response) {
                if(response == "Yes"){
                    $("#lbl-before-burrow").show();
                    $("#field-label-23").show();
                 }
                 else{
                    $("#lbl-before-burrow").hide();
                    $("#field-label-23").hide();
                    $("#field-label-23").val("");
                 }
            }
          });
      });

      $("#field-label-18").change(function(){
        $.ajax({
            type: "POST",
            url:  "/user/onChangeValueDefiner",
            data: {
                balanceDiet:$('#field-label-18').val()
             },
             success: function(response) {
                if(response == "Yes"){
                    $("#lbl-no-balance-diet").show();
                    $("#field-label-19").show();
                 }
                 else{
                    $("#lbl-no-balance-diet").hide();
                    $("#field-label-19").hide();
                    $("#field-label-19").val("");
                 }
            }
          });
      });

      $("#field-label-23").change(function(){
        $.ajax({
            type: "POST",
            url:  "/user/onChangeValueDefiner",
            data: {
                sourceOfCredit:$('#field-label-23').val()
             },
             success: function(response) {
                if(response.includes("Formal") && !response.includes("Informal")){
                    $("#lbl-formal_barrow").show();
                    $("#field-label-25").show();

                    $("#lbl-status-burrowed-formal").show();
                    $("#field-label-27").show();

                    $("#lbl-repaid-formal").show();
                    $("#field-label-28").show();

                    $("#lbl-informal-barrow").hide();
                    $("#field-label-24").hide();

                    $("#lbl-rapid-status-informal").hide();
                    $("#field-label-26").hide();

                    $("#lbl-rapid-paid-informal").hide();
                    $("#field-label-29").hide();
                 }
                 else if(response.includes("Informal") && !response.includes("Formal")){
                    $("#lbl-informal-barrow").show();
                    $("#field-label-24").show();

                    $("#lbl-rapid-status-informal").show();
                    $("#field-label-26").show();

                    $("#lbl-rapid-paid-informal").show();
                    $("#field-label-29").show();

                    $("#lbl-formal_barrow").hide();
                    $("#field-label-25").hide();

                    $("#lbl-status-burrowed-formal").hide();
                    $("#field-label-27").hide();

                    $("#lbl-repaid-formal").hide();
                    $("#field-label-28").hide();
                 }
                 else if(response.includes("Informal") && response.includes("Formal")){
                    $("#lbl-informal-barrow").show();
                    $("#field-label-24").show();

                    $("#lbl-rapid-status-informal").show();
                    $("#field-label-26").show();

                    $("#lbl-rapid-paid-informal").show();
                    $("#field-label-29").show();

                    $("#lbl-formal_barrow").show();
                    $("#field-label-25").show();

                    $("#lbl-status-burrowed-formal").show();
                    $("#field-label-27").show();

                    $("#lbl-repaid-formal").show();
                    $("#field-label-28").show();
                 }
                 else{
                    $("#lbl-informal-barrow").hide();
                    $("#field-label-24").hide();

                    $("#lbl-rapid-status-informal").hide();
                    $("#field-label-26").hide();

                    $("#lbl-rapid-paid-informal").hide();
                    $("#field-label-29").hide();

                    $("#lbl-formal_barrow").hide();
                    $("#field-label-25").hide();

                    $("#lbl-status-burrowed-formal").hide();
                    $("#field-label-27").hide();

                    $("#lbl-repaid-formal").hide();
                    $("#field-label-28").hide();  
                 }
            }
          });
      });
  });