<html>
<head>
	<title>Ajax Image Upload Using PHP and jQuery</title>
	<link rel="stylesheet" href="CSS/upload.css" />
	<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed|Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="JS/publish.js"></script>
    <script type="text/javascript" src="JS/menu.js"></script>
</head>

<body>
	<header>
			<span>
				<img align="left" width="200" height="40" src="Images/logo.png" alt="Logo" />
			</span>
		
			 <div>
			<ul id="menu">
			<li>Index</li>
			<li>Login</li>
        	<li>Register</li>
        	<li>Publish</li>
        	<li>About</li>
        	<li>Profile</li>
            <li>Logout</li>
    		</ul>
    		<ul id=search>
    		<li><input type="text" id="searchBar" size="40" name="search" placeholder="Search.."></li>
    		</ul>

    		<span id="logUser">
    		hola mundo
    		</span>
   
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
	<h4 id='loading' >loading..</h4>
	<div id="message"></div>

	<table  id="filter" align="center">
        <tr>
            <th>State</th>
            <td>
                <div>
                <input type="radio" class="check" name="Estado" value="Nuevo Leon"> Nuevo Leon<br>
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
                <input id="house" type="checkbox" class="check" name="TypeProperty" value="House">House<br>
                <input id="dept" type="checkbox" class="check" name="TypeProperty" value="Department">Department<br>
                </div>
            </td>
        </tr>
        <tr>
            <th>Price</th>
            <td>
                <div>
                <input id="price" placeholder="$$$" type="number">
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