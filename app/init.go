package app

import (
	"database/sql"
	"encoding/json"
	"fmt"
	"io/ioutil"
	"os"
	"path"
	"runtime"

	_ "github.com/mattn/go-sqlite3"
	"github.com/revel/revel"
)

var G_DB *sql.DB
var G_CFG FameCfg

var G_model_detail_html = `
	<!DOCTYPE html>
	<html>
	<head lang="en">
	    <meta charset="UTF-8">
	    <title></title>
	    <style>
	        body {
	            background:#000000;
	        }
	
	        .panel-transparent {
	            background: none;
	        }
	
	        .panel-transparent .panel-heading{
	            background: rgba(0, 0, 0, 0);
	        }
	
	        .panel-transparent .panel-body{
	            background: rgba(0, 0, 0, 0);
	        }
	        p {
	            color: #ffffff;
	        }
	        h3{
	            color: #ffffff;
	        }
	        a{
	            color: #ffffff;
	        }
	        span{
	            color: #ffffff;
	        }
	        i{
	            color: #ffffff;
	        }
	        label{
	            color: #ffffff;
	        }
	        .panel.noborder {
	            border: none;
	            box-shadow: none;
	        }
	        button {
	            margin-top: 10px;
	            border-color: #aaaaaa;
	            color: #ffffff;
	            background:#000000;
	            padding-left: 20px;
	            padding-right: 20px;
	            padding-top: 10px;
	            padding-bottom: 10px;
	        }
	        button:hover{
	            border-color: #ffffff;
	        }
	        </style>
	</head>
	<body>
	<div class="panel panel-primary panel-transparent noborder" >
	    <div class="panel-heading noborder">
	        <h3 class="panel-title">MODEL INFOMATION</h3>
	    </div>
	    <div class="panel-body noborder">
	        <div class="row">
	
	            <div class="col-md-12" id="portfolio-ajax-content-container">
	
	                <div class="layout-half" id="portfolio-content">
	                    <div class="thumb">
	                        <img src="/public/img/%s/detail.jpg"
	                             alt="">
	                    </div>
	                    <!-- .thumb -->
	                    <div class="details">
	                        <h3>%s</h3>
	
	                        <div class="desc">
	                            <p>%s</p>
	
	                        </div>
	                        <!-- .desc -->
	                        <div class="info">
	                            <ul>
	                                <li><i class="icon-user"></i><label >Model Name:</label> <span
	                                        class="prop">%s</span>
	                                </li>
	                                <li><i class="icon-map-marker"></i><label >Location:</label> <span
	                                        class="prop">%s</span></li>
	
	                            </ul>
	                        </div>
	                        <!-- .info -->
	                        <div class="">
	                            <button class="btn-launch" 
	                               target="_self" style="" id="model-gallery-%s" name="%s">Gallery</button>
	                        </div>
	                        <!-- .wi-button -->
	                    </div>
	                    <!-- .details -->
	                </div>
	                <!-- #portfolio-content -->
	            </div>
	
	        </div>
	    </div>
	</div>
	
	<script>
		$(function () {
			$("body").on("click", "[id^=model-gallery]", function(e) {
				var model_name = $(this).attr( "name");
				window.open("model-gallery?name="+model_name);
			});
		});
	</script>
	</body>
	</html>
	`

type FameCfg struct {
	PublicPathUnix string `json:"PublicPathUnix"`
	PublicPathWin  string `json:"PublicPathWin"`
}

func init() {
	// Filters is the default set of global filters.
	revel.Filters = []revel.Filter{
		revel.PanicFilter,             // Recover from panics and display an error page instead.
		revel.RouterFilter,            // Use the routing table to select the right Action
		revel.FilterConfiguringFilter, // A hook for adding or removing per-Action filters.
		revel.ParamsFilter,            // Parse parameters into Controller.Params.
		revel.SessionFilter,           // Restore and write the session cookie.
		revel.FlashFilter,             // Restore and write the flash cookie.
		revel.ValidationFilter,        // Restore kept validation errors and save new ones from cookie.
		revel.I18nFilter,              // Resolve the requested language
		HeaderFilter,                  // Add some security based headers
		revel.InterceptorFilter,       // Run interceptors around the action.
		revel.CompressFilter,          // Compress the result.
		revel.ActionInvoker,           // Invoke the action.
	}

	// register startup functions with OnAppStart
	// ( order dependent )
	// revel.OnAppStart(InitDB)
	// revel.OnAppStart(FillCache)
	var err error
	G_DB, err = sql.Open("sqlite3", "./fame.db")
	if err != nil {
		panic(err.Error())
	}

	func() {
		fi, err := os.Open("fame.cfg")
		if err != nil {
			panic(err)
		}
		defer fi.Close()
		fd, err := ioutil.ReadAll(fi)
		// fmt.Println(string(fd))

		err = json.Unmarshal(fd, &G_CFG)
		if err != nil {
			panic(err.Error())
		}

		model_cnt := GetModelCount()
		for m_i := 1; m_i <= model_cnt; m_i++ {
			model_data := GetModelInfoBySequence(m_i)
			//fmt.Println(model_data.Name)
			var d1 = []byte(fmt.Sprintf(G_model_detail_html,
				model_data.Name,
				model_data.Name,
				model_data.Name,
				model_data.Name,
				model_data.Location,
				model_data.Name,
				model_data.Name))
			public_path := G_CFG.PublicPathUnix
			if runtime.GOOS == "windows" {
				public_path = G_CFG.PublicPathWin
			}
			err2 := ioutil.WriteFile(path.Join(public_path, "modeldetail", fmt.Sprintf("model_%s_detail.html", model_data.Name)), d1, 0666)
			if err2 != nil {
				fmt.Println(err2.Error())
			}
		}
	}()
}

// TODO turn this into revel.HeaderFilter
// should probably also have a filter for CSRF
// not sure if it can go in the same filter or not
var HeaderFilter = func(c *revel.Controller, fc []revel.Filter) {
	// Add some common security headers
	c.Response.Out.Header().Add("X-Frame-Options", "SAMEORIGIN")
	c.Response.Out.Header().Add("X-XSS-Protection", "1; mode=block")
	c.Response.Out.Header().Add("X-Content-Type-Options", "nosniff")

	fc[0](c, fc[1:]) // Execute the next filter stage.
}
