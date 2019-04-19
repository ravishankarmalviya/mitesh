import { Injectable } from '@angular/core';
import { User } from './user';


@Injectable({
  providedIn: 'root'
})
export class AuthService {

  userlogedin:boolean;
  username:string;

  

  constructor() { }

  public login(userInfo: User){
    this.username=userInfo.email;
    localStorage.setItem('ACCESS_TOKEN', "access_token");
  }

   

  public isLoggedIn(){    
    if(localStorage.getItem('ACCESS_TOKEN') !== null){
      this.userlogedin=true;
      return this.userlogedin;
    }else{
      this.userlogedin=false;
      return this.userlogedin;
    }
    
    

  }

  public logout(){
    this.username='';
    localStorage.removeItem('ACCESS_TOKEN');
  }
}
