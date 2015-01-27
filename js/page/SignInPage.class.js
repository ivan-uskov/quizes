var SignInPage = Page.extend({

    email: null,
    password: null,

    constructor: function()
    {
        this.email = $('#login');
        this.password = $('#password');
        this.emailError = $('#emailErrorBox');
        this.passwordError = $('#passwordErrorBox');

        var thisPtr = this;
        $('#submit').click(function(){ thisPtr.submitHandler() });
        this.email.change(function(){ thisPtr.emailChangeHandler() });
        this.password.change(function(){ thisPtr.passwordChangeHandler() });
    },

    submitHandler: function()
    {
        if (this.getEmail() && this.checkPassword())
        {
            this.submitForm(this.getEmail(), this.getPassword());
        }
    },

    submitForm: function(email, password)
    {
        var thisPtr = this;
        var data =
        {
            email: email,
            password: password
        };

        $.post( location.href, data).done(function( data ) { thisPtr.signInResponse(data); });
    },

    signInResponse: function(data)
    {
        data = JSON.parse(data);
        if (data.success)
        {
            location.href = location.origin;
        }
        else
        {
            alert("User width this data not exists!");
        }
    },

    getEmail: function()
    {
        return this.email.val();
    },

    getPassword: function()
    {
        return this.password.val();
    },

    emailChangeHandler: function()
    {
        if (!this.checkEmail())
        {
            this.emailError.show();
        }
        else
        {
            this.emailError.hide();
        }
    },

    passwordChangeHandler: function()
    {
        if (!this.checkPassword())
        {
            this.passwordError.show();
        }
        else
        {
            this.passwordError.hide();
        }
    },

    checkEmail: function()
    {
        return /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(this.getEmail());
    },

    checkPassword: function()
    {
        return /^[0-9a-zA-Z]+$/.test(this.getPassword());
    }

});

new SignInPage();


