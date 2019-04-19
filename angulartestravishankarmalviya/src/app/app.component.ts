import { BrowserModule } from  '@angular/platform-browser';
import { NgModule,ViewChild } from  '@angular/core';
import { Component } from '@angular/core';

import { MatTableModule } from  '@angular/material';  
import { NavComponent } from './nav/nav.component';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent {
  public userlogedin: NavComponent;
  title = 'firstangular';

  @ViewChild('contentPlaceholder') set content(content:NavComponent ) {
    this.userlogedin = content;

    }

  servers = [];
  serverElements = [{type: 'server', name: 'Testserver', content: 'Just a test!'}];

  onAddServer() {
    this.servers.push('Another Server');
  }

  onRemoveServer(id: number) {
    const position = id + 1;
    this.servers.splice(position, 1);
  }

  onServerAdded(serverData: {serverName: string, serverContent: string}) {
    this.serverElements.push({
      type: 'server',
      name: serverData.serverName,
      content: serverData.serverContent
    });
  }

  onBlueprintAdded(blueprintData: {serverName: string, serverContent: string}) {
    this.serverElements.push({
      type: 'blueprint',
      name: blueprintData.serverName,
      content: blueprintData.serverContent
    });
  }

  onChangeFirst() {
    this.serverElements[0].name = 'Changed!';
  }

  onDestroyFirst() {
    this.serverElements.splice(0, 1);
  }
}
