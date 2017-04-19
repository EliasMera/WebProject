<html>
<head>
	<title>Ajax Image Upload Using PHP and jQuery</title>
	<link rel="stylesheet" href="CSS/upload.css" />
	<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed|Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="JS/publish.js"></script>
    <script type="text/javascript" src="JS/menu.js"></script>
    <script type="text/javascript" src="JS/publish.js"></script>
    
</head>

<body>
	<header>
			<span>
				<img align="left" width="200" height="80" src="Images/logo.jpg" alt="Logo" />
			</span>
		
			 <div>
			<ul id="menu">
                <li id="home">Home</li>
                <li id="login">Login</li>
                <li id="register">Register</li>
                <li id="publish">Publish</li>
                <li id="about">About</li>
                <li id="profile">Profile</li>
                <li id="myuploads">My uploads</li>
                <li id="logout">Logout</li>
    		</ul>
    		<ul id=search>
    		<li><input type="text" id="searchBar" size="40" name="search" placeholder="Search.."></li>
            <li> <span id="logUser"></span></li>
    		</ul>


   
    		</div>
   	</header>

	<div class="main">
		<h1>Ajax Image Upload</h1><br/>
		<hr>
		<form id="uploadimage" action="" method="post" enctype="multipart/form-data">
			<div id="image_preview"><img id="previewing" src="noimage.png" /></div>
			<hr id="line">
			<div id="selectImage">
				<label>Select Your Image</label><br/>
				<input type="file" name="file" id="file" required />
				<input type="submit" value="Upload" class="submit" />
			</div>
		</form>
	</div>
	<div id="message"></div>

	<table  id="filter" align="left">
        <tr>
            <th>Tittle</th>
            <td>
            <textarea id="textBoxTitle" name="textBoxTitle" cols="20" rows="5"></textarea>
            </td>
        </tr>
        <tr>
            <th>Location</th>
            <td>
            <textarea id="textBoxDirection" name="textBoxDirection" cols="20" rows="5"></textarea>
            </td>
        </tr>
        <tr>
            <th>Description</th>
            <td>
            <textarea id="textBoxDescription" name="textBoxDescription" cols="20" rows="5"></textarea>
            </td>
        </tr>
        <tr>
            <th>State</th>
            <td>
                <div>
                <input type="radio" class="check" name="Estado" value="Nuevo Leon" checked> Nuevo Leon<br>
                <input type="radio" class="check" name="Estado" value="Coahuila"> Coahuila<br>
                </div> 
            </td>
        </tr>
        <tr>
            <th>Type of operation</th>
            <td>
                <div>
                <input id="rent" type="checkbox" class="check" name="Ope" value="Renta">For Rent<br>
                <input id="sell" type="checkbox" class="check" name="Ope" value="Venta">For Sell<br>
                </div>
            </td>
        </tr>
        <tr>
            <th>Type Property</th>
            <td>
                <div>
                <input id="house" type="radio" class="check" name="TypeProperty" value="House" checked>House<br>
                <input id="dept" type="radio" class="check" name="TypeProperty" value="Department">Department<br>
                </div>
            </td>
        </tr>
        <tr>
            <th>Price</th>
            <td>
                <div>
                <input id="price" placeholder="$$$" type="number" min="0">
                </div>
            </td>
        </tr>
        <tr>
            <th>General</th>
            <td>
                <div>
                <input id="school" type="checkbox" class="check" name="school" value="School">Near Schools<br>
                <input id="market" type="checkbox" class="check" name="market" value="Market">Near Market<br>
                <input id="pool" type="checkbox" class="check" name="pool" value="Pool">Pool<br>
                </div>
            </td>
        </tr>
    </table>
</body>
</html>