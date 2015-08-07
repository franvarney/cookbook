Recipe = (function () {
  var el = {};
  return {
    init: function () {
      el.dirButton  = $('#add-direction');
      el.dirUl      = $('#add-directions');
      el.dirLast    = el.dirUl.children().last();
      el.dirRemove  = $('.remove-direction');
      el.ingButton  = $('#add-ingredient');
      el.ingUl      = $('#add-ingredients');
      el.ingLast    = el.ingUl.children().last();
      el.ingRemove  = $('.remove-ingredient');
      //el.recipeForm = $('.recipe-form');
      this.addDirection();
      this.addIngredient();
      this.removeDirection();
      this.removeIngredient();
      //this.submitRecipe();
    },
    addDirection: function () {
      el.dirButton.click(function (e) {
        e.preventDefault();
        var li = el.dirLast.clone(true);
        $.each(li.children(), function (index, child) {
          child.value = null;
        });
        el.dirUl.append(li);
      });
    },
    addIngredient: function () {
      el.ingButton.click(function (e) {
        e.preventDefault();
        var li = el.ingLast.clone(true);
        $.each(li.children(), function (index, child) {
          child.value = null;
        });
        el.ingUl.append(li);
      });
    },
    removeDirection: function () {
      el.dirRemove.click(function (e) {
        e.preventDefault();
        $(e.target).parent().remove();
      });
    },
    removeIngredient: function () {
      el.ingRemove.click(function (e) {
        e.preventDefault();
        $(e.target).parent().remove();
      });
    },
    submitRecipe: function () {
      // el.recipeForm.submit(function (e) {
      //   $.ajax({
      //       type: el.recipeForm.attr('method'),
      //       url: el.recipeForm.attr('action'),
      //       data: el.recipeForm.serialize(),
      //       success: function (data, textStatus, jqXHR) {
      //         console.log(data);
      //         window.location.href = '/recipe/' + data.recipe_id;
      //       },
      //       error: function (err) {
      //         console.log(err);
      //       }
      //   });
      //   e.preventDefault();
      // });
    }
  }
})();

$(document).ready(function() {
  Recipe.init();
});

//# sourceMappingURL=main.js.map