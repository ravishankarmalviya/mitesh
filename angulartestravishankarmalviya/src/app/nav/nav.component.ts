import { Component, OnInit,Input } from '@angular/core';
import { Router } from '@angular/router';
import { AuthService } from '../auth.service';

@Component({
  selector: 'app-nav',
  templateUrl: './nav.component.html',
  styleUrls: ['./nav.component.scss']
})
export class NavComponent implements OnInit {
  appTitle = 'myapp';
  
  

  constructor(public authService: AuthService, private router: Router) { }

  ngOnInit() {

    this.authService.isLoggedIn();
    
  }

  logout(){
    
    
    this.authService.logout();
    this.router.navigateByUrl('/login');
  }

}
