var app = angular.module("cartApp", []);

app.run(function($rootScope) {
    $rootScope.cart = [];
    $rootScope.cart_empty = true;
    $rootScope.len = 0;
});

app.controller("getCtrl", function($scope, $rootScope) {
    
    $scope.id = 0;

    $scope.addCart = function(n) {
        
        if(!check())
        {
            return;
        }
        
        $scope.id += 1;
        $rootScope.len += 1;
        $rootScope.cart_empty = false;
        if(n == 1)
        {
            $rootScope.cart.push({id: $scope.id,
                img: 'product1.jpg',
                title: 'Elements of Mechanical Engineering',
                price: 'Rs. 160'});
        }
        if(n == 2)
        {
            $rootScope.cart.push({id: $scope.id,
                img: 'product2.jpg',
                title: 'Basic Electrical Engineering',
                price: 'Rs. 200'});
        }
        if(n == 3)
        {
            $rootScope.cart.push({id: $scope.id,
                img: 'product3.jpg',
                title: 'Higher Engineering Mathemetics',
                price: 'Rs. 250'});
        }
        if(n == 4)
        {
            $rootScope.cart.push({id: $scope.id,
                img: 'product4.jpg',
                title: 'Algorithms in C',
                price: 'Rs. 280'});
        }

        alert("Item has been added to your cart!");
    };

});

app.controller("removeCtrl", function($scope, $rootScope) {
        
    $scope.removeCart = function(id) {
        $rootScope.len -= 1;

        $rootScope.cart.forEach((e,i) => {
        if(e.id == id)
        {
            $rootScope.cart.splice(i, 1);
        }
        if($rootScope.cart.length == 0)
        {
            $rootScope.cart_empty = true;
        }
        });
    };

    $scope.buy = function(info) {
        localStorage.setItem('book',JSON.stringify(info));
        window.open('checkout.html');
        console.log(localStorage.getItem('book'));
    };

});
