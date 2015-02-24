$(function() {
  formId = 'fieldset_form';
  var allConditionalFields = new Array(
    'deleteAll', 'cloneToSubcats', 'cloneToCats', 'cloneFromCat'
  );
  var allConditionFields = new Array(
    'deleteAll', 'cloneToSubcats', 'cloneToCats', 'cloneFromCat'
  );
  //dump(cfForm);
  disableFields( allConditionalFields );
  hideAndDisplay(1);
  addConditionalEvents( allConditionFields );
});

function hideAndDisplay(firstCall)
{
  var form = $('#'+formId);
  var formVals = form.formHash();
  formVals.cloneToCats=$('#asmList0 li').length;
  if( typeof formVals.cloneToSubcats == 'undefined' || formVals.cloneToSubcats=='' ) formVals.cloneToSubcats=0;
  if( typeof formVals.deleteAll == 'undefined' || formVals.deleteAll=='' ) formVals.deleteAll=0;
  displayField( 'deleteAll', (formVals.cloneToSubcats==0 && formVals.cloneToCats==0 && formVals.cloneFromCat==0));
  displayField( 'cloneToSubcats', (formVals.deleteAll==0 && formVals.cloneToCats==0 && formVals.cloneFromCat==0));
  displayField( 'cloneToCats', (formVals.deleteAll==0 && formVals.cloneToSubcats==0 && formVals.cloneFromCat==0));
  displayField( 'cloneFromCat', (formVals.deleteAll==0 && formVals.cloneToSubcats==0 && formVals.cloneToCats==0));
  // hogy a form le-fel nyilasa ne legyen zavaro, mindig a kepernyo legaljara pozicionalunk:
  if( firstCall!=1 ) $(window).scrollTop($(document).height() - $(window).height());
}

function displayField( field, condition )
{
  var row = $("#"+field).parents('tr.row');
  if( condition )  row.show();
  else row.hide();
}

function disableFields( fields )
{
  $.each( fields, function() {
    $("#" + this).parents('tr.row').hide();     
  });
}

function addConditionalEvents( fields )
{
  $.each( fields, function() {
    $("#"+formId+" select[name='"+this+"']").change(hideAndDisplay);  
  });
  $.each( fields, function() {
    $("#"+formId+" input[name='"+this+"']").click(hideAndDisplay);  
  });
}
