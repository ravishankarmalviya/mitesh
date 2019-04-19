import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from  'rxjs';
import { User } from './user';


@Injectable({
  providedIn: 'root'
})
export class AuthService {

  userlogedin:boolean;
  username:string;
  PHP_API_SERVER = "http://localhost";
  //userInfodata: string;
  

  constructor(private httpClient: HttpClient) { }

  login(userInfo: User): Observable<User>{
    return this.httpClient.post<User>(`${this.PHP_API_SERVER}/api/userlogin.php`, userInfo);
  }

  /* public login(userInfo: User){
    this.username=userInfo.email;
    //console.log(this.);

    this.createPolicy(userInfo).subscribe((userInfodata: User)=>{
      
      //this.userInfodata = "loged in";
      console.log("User loged in, "+ JSON.stringify(userInfodata));
    });
    
    console.log(userInfodata);
    localStorage.setItem('ACCESS_TOKEN', "access_token");
    //return this.userInfodata;
  }*/

   

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
