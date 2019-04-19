import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from  '@angular/forms';
import { Router } from  '@angular/router';
import { User } from  '../user';
import { Loginstatus } from  '../loginstatus';
import { AuthService } from  '../auth.service';
import { NullAstVisitor } from '@angular/compiler';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {

  constructor(private authService: AuthService, private router: Router, private formBuilder: FormBuilder ) { }

  loginForm: FormGroup;
  isSubmitted  =  false;
  userlogedinresponse: Loginstatus ;
  userloginstatus:boolean;
  userloginmessage:string;
  
  
  ngOnInit() {
    this.authService.isLoggedIn();

      this.loginForm  =  this.formBuilder.group({
          email: ['', Validators.required],
          password: ['', Validators.required]
      });

  }

  get formControls() { return this.loginForm.controls; }

  login(){
    
    console.log(this.loginForm.value);
    this.isSubmitted = true;
    if(this.loginForm.invalid){
      return;
    }
     //this.authService.login(this.loginForm.value);

     this.authService.login(this.loginForm.value).subscribe((userInfodata: User)=>{
      
      //this.userlogedinresponse = {error:userInfodata['error'],message:userInfodata['message']};
      this.userloginstatus = userInfodata['error'];
      this.userloginmessage = userInfodata['message'];
      
      
    });

    console.log("User loged in, "+ this.userloginstatus+" "+this.userloginmessage);
    
    //console.log(this.authService.userInfodata);
    //this.router.navigateByUrl('/dashboard');
  }

}
