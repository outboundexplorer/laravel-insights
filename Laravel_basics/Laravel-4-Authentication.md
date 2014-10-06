#### Laravel 4 Authentication - 16 part series (tags: LARAVEL__Authentication)




#06 - PDO and SMTP Email 
https://www.youtube.com/watch?v=ntUQGzgSkck&index=6&list=PLfdtiltiRHWGf_XXdKn60f8h9jjn_9QDp 


Video shows how to set up for connecting to the database and sending emails using gmail. (tags: gmail, email, smtp, pdo, LARAVEL__SendEmail)

####Insights
(1)	When using gmail to send emails, it is necessary to go to gmail settings and ‘allow for access by less secure apps’.






#10 - Signing In 
https://www.youtube.com/watch?v=776RTCepW80&list=PLfdtiltiRHWGf_XXdKn60f8h9jjn_9QDp&index=10  

	
Setting up the **signin.blade.php** file and creating the **postSignIn** and **getSignIn** methods in the **AccountController** class. (tags: SigningIn)
 

####Insights
(1)	When using standard **<form>** tags to create a form, we must include a **Form::token()** to avoid **TokenMismatchException**.  (If using **Form::open()** & **Form::close()**, a token is automatically included and **Form::token()** is not needed.





#11 - Signing Out 
https://www.youtube.com/watch?v=qzAe9I4kj1Q&list=PLfdtiltiRHWGf_XXdKn60f8h9jjn_9QDp&index=11 

Create signing out capability by editing the **routes.php**, **filters.php**, **navigation.blade.php** and **AccountController.php** files. (tags: SigningOut) 

####Insights
(1)	 Since **Laravel 4.1.26** it is necessary to have a **remember_token** column to your **users** database table.  This must be **VARCHAR(100)** and **nullable**.  Also, need to add three public functions to the **User** class. (refer to: http://laravel.com/docs/4.2/upgrade#upgrade-4.1.26 )








#12 - Remember Me 	
https://www.youtube.com/watch?v=qzAe9I4kj1Q&list=PLfdtiltiRHWGf_XXdKn60f8h9jjn_9QDp&index=12 

	
Create ‘Remember Me’ capability by editing **signin.blade.php** and **AccountController.php**.  Check that a new ‘remember’ cookie has been set by inspecting the cookies in the browser.





#13 - Changing Password 
https://www.youtube.com/watch?v=qzAe9I4kj1Q&list=PLfdtiltiRHWGf_XXdKn60f8h9jjn_9QDp&index=13 

	
Create ChangingPassword functionality by editing **navigation.blade.php**, **routes.php** and **AccountController.php**.  Also create new file **password.blade.php**. (tags: RememberMe)

####Insights
(1)	 We can use the **Hash::check()** method to compare the hash of a user entered password **Input::get(‘password’)** with the password stored in the database **$user->getAuthPassword**.

(2)	We can use **$user = User::find(Auth::user()->id)** to create a **$user** object of the current logged in user.

(3)	We can store the new password to the database using **$user->password = Hash::make($password)**



#14 - User Profiles 
https://www.youtube.com/watch?v=uYJ_UJUzgqM&index=14&list=PLfdtiltiRHWGf_XXdKn60f8h9jjn_9QDp 
	
Develop a User Profile template called **user.blade.php**.  The **routes.php** is modified to allow for a dynamic variable to be passed and so allowing for different users.  The **ProfileController.php** file is also modified to create the necessary response when called into action by the browser as designated by the **routes.php file**.  (tags: UserProfile) 

####Insights
(1)	 We use curly brackets in the URL to denote that we are passing a dynamic value.  **Route::get(‘/user/{username}’, array())**




#15 – Account Recovery
https://www.youtube.com/watch?v=nSOPuYkllYQ&index=15&list=PLfdtiltiRHWGf_XXdKn60f8h9jjn_9QDp 

When we select the **Forgot Password** link, a new form is available for us to enter our email address.  Standard email validation is carried out on the input of this form and checks that there is a user in the database with this email address. At which point a **password_temp** is created for the user and a **code** is assigned to the current user.  The **code** and **password_temp** are emailed to the user.  The user must activate the link (comprising the code) in order to allow the system to set the password to the same as the **password_temp**.  The user is then able to use the **password_temp** to access their account.  (tags: AccountRecovery)

####Insights
(1)	All user input that is output directly to the screen using **Input::old()** must be escaped properly.  Written as follows when used inside **blade**:  **{{Form::text(‘email’, null, array(‘value’=> e(Input::old’email’)) ))}}**
(Note:  not sure whether it would have just been ok to place all the content in **{{{ }}}** curly braces – but I think that this might have meant that we were escaping the input also which is not good practice)  

(2)	In the **profile.blade.php** file, we can escape the user data by simply using triple curly braces like **Hello, {{{ $user->username }}}**

