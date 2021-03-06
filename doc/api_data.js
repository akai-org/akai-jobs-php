define({ "api": [
  {
    "type": "get",
    "url": "/api/oauth/getclients",
    "title": "Clients",
    "name": "PasswordClients",
    "description": "<p>Returns client list and their data to be used in authenthication</p>",
    "group": "Users",
    "examples": [
      {
        "title": "Pseudocode example:",
        "content": "$http([\n    method => \"GET\",\n    url => \"http://{base_url}/api/oauth/getclients\"\n]);",
        "type": "js"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "array",
            "optional": true,
            "field": "data.clients",
            "description": "<p>Client list</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "message",
            "description": "<p>Success message</p>"
          },
          {
            "group": "Success 200",
            "type": "array",
            "optional": false,
            "field": "data",
            "description": "<p>Data array</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/GetToken.php",
    "groupTitle": "Users",
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "string",
            "optional": false,
            "field": "message",
            "description": "<p>Error message</p>"
          },
          {
            "group": "Error 4xx",
            "type": "object",
            "optional": true,
            "field": "errors",
            "description": "<p>Errors object</p>"
          },
          {
            "group": "Error 4xx",
            "type": "string",
            "optional": true,
            "field": "exception",
            "description": "<p>Exception</p>"
          },
          {
            "group": "Error 4xx",
            "type": "string",
            "optional": true,
            "field": "file",
            "description": "<p>Error file</p>"
          },
          {
            "group": "Error 4xx",
            "type": "int",
            "optional": true,
            "field": "line",
            "description": "<p>Error line</p>"
          },
          {
            "group": "Error 4xx",
            "type": "array",
            "optional": true,
            "field": "trace",
            "description": "<p>Error trace</p>"
          }
        ]
      }
    }
  },
  {
    "type": "get",
    "url": "api/users/:user_id",
    "title": "My profile",
    "name": "ShowMeMyself",
    "description": "<p>Get current user details</p>",
    "group": "Users",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "object",
            "optional": false,
            "field": "data.user",
            "description": "<p>Data about user</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "message",
            "description": "<p>Success message</p>"
          },
          {
            "group": "Success 200",
            "type": "array",
            "optional": false,
            "field": "data",
            "description": "<p>Data array</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/UserController.php",
    "groupTitle": "Users",
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "string",
            "optional": false,
            "field": "message",
            "description": "<p>Error message</p>"
          },
          {
            "group": "Error 4xx",
            "type": "object",
            "optional": true,
            "field": "errors",
            "description": "<p>Errors object</p>"
          },
          {
            "group": "Error 4xx",
            "type": "string",
            "optional": true,
            "field": "exception",
            "description": "<p>Exception</p>"
          },
          {
            "group": "Error 4xx",
            "type": "string",
            "optional": true,
            "field": "file",
            "description": "<p>Error file</p>"
          },
          {
            "group": "Error 4xx",
            "type": "int",
            "optional": true,
            "field": "line",
            "description": "<p>Error line</p>"
          },
          {
            "group": "Error 4xx",
            "type": "array",
            "optional": true,
            "field": "trace",
            "description": "<p>Error trace</p>"
          }
        ]
      }
    },
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "string",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Auth Token</p>"
          }
        ]
      }
    }
  },
  {
    "type": "get",
    "url": "/api/users/logout",
    "title": "Logout",
    "name": "UserLogout",
    "description": "<p>Logout user.</p>",
    "group": "Users",
    "examples": [
      {
        "title": "Pseudocode example:",
        "content": "$http([\n    method => \"POST\"\n    url => \"http://{base_url}/api/users/logout\",\n    headers => [\n        Authorization => Bearer {TOKEN}\n    ]\n]);",
        "type": "js"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "message",
            "description": "<p>Successful logout message</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/UserController.php",
    "groupTitle": "Users",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "string",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Auth Token</p>"
          }
        ]
      }
    }
  },
  {
    "type": "post",
    "url": "api/oauth/token",
    "title": "Login",
    "name": "Login",
    "description": "<p>Tries to log user in. For client data go to: Clients</p>",
    "group": "users",
    "parameter": {
      "fields": {
        "POST Param": [
          {
            "group": "POST Param",
            "optional": false,
            "field": "client_id",
            "description": "<p>Passport generated client's ID</p>"
          },
          {
            "group": "POST Param",
            "optional": false,
            "field": "client_secret",
            "description": "<p>Passport generated client's secret</p>"
          },
          {
            "group": "POST Param",
            "optional": false,
            "field": "username",
            "description": "<p>user's mail</p>"
          },
          {
            "group": "POST Param",
            "optional": false,
            "field": "password",
            "description": "<p>user's password</p>"
          },
          {
            "group": "POST Param",
            "optional": false,
            "field": "grant_type",
            "description": "<p>Grant access type, type: &quot;password&quot;</p>"
          }
        ],
        "Url Params": [
          {
            "group": "Url Params",
            "type": "int",
            "optional": false,
            "field": ":user_id",
            "description": "<p>Requested user's ID</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "token_type",
            "description": "<p>Token type</p>"
          },
          {
            "group": "Success 200",
            "type": "int",
            "optional": false,
            "field": "expires_in",
            "description": "<p>Time to token expiration (seconds)</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "access_token",
            "description": "<p>Access Token</p>"
          },
          {
            "group": "Success 200",
            "type": "string",
            "optional": false,
            "field": "refresh_token",
            "description": "<p>Refresh token</p>"
          },
          {
            "group": "Success 200",
            "type": "object",
            "optional": false,
            "field": "data.user",
            "description": "<p>Data about user</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "string",
            "optional": false,
            "field": "error",
            "description": "<p>Error</p>"
          },
          {
            "group": "Error 4xx",
            "type": "string",
            "optional": false,
            "field": "message",
            "description": "<p>Rrror details</p>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Pseudocode example:",
        "content": "$http([\n    method => \"POST\"\n    url => \"http://{base_url}/api/oauth/token\",\n    data => [\n         \"client_id\" => 2,\n         \"username\" => \"test@testownia.pl\",\n         \"password\" => \"test123\",\n         \"grant_type\" => \"password\",\n         \"client_secret\" => \"abcdefghijkl\"\n    ]\n]);",
        "type": "js"
      }
    ],
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/ApiController.php",
    "groupTitle": "users"
  }
] });
