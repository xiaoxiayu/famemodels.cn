package controllers

import (
	"fmt"

	"fame/app"
	"math"

	"github.com/revel/revel"

	_ "github.com/mattn/go-sqlite3"
)

type App struct {
	*revel.Controller
}

func getModelCount() int {
	rows, err := app.G_DB.Query("SELECT COUNT(name) FROM model")
	if err != nil {
		return -1
	}

	var cnt int
	for rows.Next() {
		err = rows.Scan(&cnt)
		if err != nil {
			return -1
		}
	}
	return cnt
}

type ModleUrl struct {
	Thumb string
}

type ModleData struct {
	Name     string
	Squence  int
	Sex      int
	Age      int
	Location string
	Info     string

	URL ModleUrl
}

func getModels(sequence, limit int) []ModleData {
	rows, err := app.G_DB.Query(fmt.Sprintf("SELECT name,sequence,location,info FROM model ORDER BY sequence limit %d,%d", sequence, limit))
	model_datas := []ModleData{}
	for rows.Next() {
		model_data := ModleData{}

		err = rows.Scan(
			&model_data.Name,
			&model_data.Squence,
			&model_data.Location,
			&model_data.Info)
		if err != nil {
			fmt.Println(err.Error())
		}
		model_datas = append(model_datas, model_data)
	}
	return model_datas
}

func getModelsName(sequence, limit int) []ModleData {
	rows, err := app.G_DB.Query(fmt.Sprintf("SELECT name FROM model ORDER BY sequence limit %d,%d", sequence, limit))
	model_datas := []ModleData{}
	for rows.Next() {
		model_data := ModleData{}

		err = rows.Scan(&model_data.Name)
		if err != nil {
			fmt.Println(err.Error())
		}
		model_datas = append(model_datas, model_data)
	}
	return model_datas
}

func getModelsInfo(name string) ModleData {
	rows, err := app.G_DB.Query(fmt.Sprintf(`SELECT location,info FROM model WHERE name='%s'`, name))
	model_data := ModleData{}
	for rows.Next() {
		model_data := ModleData{}

		err = rows.Scan(&model_data.Location, &model_data.Info)
		if err != nil {
			fmt.Println(err.Error())
		}
		return model_data
	}
	return model_data
}

func (c App) Index() revel.Result {
	//createModelInfoHtml()
	return c.Render()
}

func (c App) ModelGallery() revel.Result {

	return c.Render()
}

func (c App) LoadPortfolioContent(name string) revel.Result {
	//fmt.Println("Model Name:", name)
	model_data := getModelsInfo(name)
	//fmt.Println(model_data)
	res_str := fmt.Sprintf(`
				<div class="panel panel-default" style="border:none;" id="model-detail-container">
				<div class="panel-body">
                <div class="row">
                    <HR style=" FILTER: progid:DXImageTransform.Microsoft.Shadow(color:#000000,direction:1145,strength:2); "
                         color=#987cb9 SIZE=1>
                    <div class="col-md-4" style="float:left;text-align: left">
                        <h3><a href="javascript:void(0);" style="text-decoration: none;"><i class="icon-chevron-left"></i>Previous</a></h3>
                    </div>
                    <div class="col-md-4" style="float:left;text-align: center;margin-left: -7px" id="info-close">
                        <a href="javascript:void(0);" style="text-decoration: none;"><h3 class="glyphicon glyphicon-remove"></h3></a>
                        <!--<h3><a><span class="glyphicon glyphicon-remove"></span>&times;</a></h3>-->

                    </div>
                    <div class="col-md-4" style="float:left;text-align: right;margin-left: -7px">
                        <h3><a href="javascript:void(0);" style="text-decoration: none;">Next<i class="icon-chevron-right"></i></a></h3>

                    </div>
                    <HR style=" FILTER: progid:DXImageTransform.Microsoft.Shadow(color:#000000,direction:1145,strength:2); "
                         color=#987cb9 SIZE=1>

                    <div class="col-md-12" id="portfolio-ajax-content-container">

                        <div class="layout-half" id="portfolio-content">
							<div class="thumb">
                                <img src="/public/img/%s/detail.jpg"
                                     class="attachment-thumb-600-crop wp-post-image"
                                     alt="2013_03_08_12_03_13_dla_niego_ochnik_wiosna_lato_2013 - Kopia - Kopia - Kopia - Kopia">
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
                                <div class="launch">
                                    <a class="btn-launch" href="#"
                                       target="_self">Gallery</a>
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
		`, name, name, model_data.Info, name, model_data.Location)
	return c.RenderJson(res_str)
}

func (c App) ModelPortfolio(page, state int) revel.Result {
	//fmt.Println("PAGE:", page)
	model_cnt := getModelCount()
	page_cnt := float64(float64(model_cnt) / 6.0)
	page_cnt = math.Ceil(page_cnt)
	if page_cnt == 0 {
		page_cnt = 1
	}

	if page > int(page_cnt) || page <= 0 {
		return c.RenderJson("")
	}

	var pagebar_str string
	if page == 1 {
		pagebar_str = `
	      <li><span class='page-number'>1</span></li>
		`
	} else {
		pagebar_str = fmt.Sprintf(`<li><a class="prev page-number" id="%d" href="javascript:void(0);"> <i class="icon-angle-left"></i>Previous</a></li>`, page-1)
		pagebar_str += `
	      <li><a class="page-number" id="1" href="javascript:void(0);">1</a></li>
		`
	}

	for page_i := 2; page_i <= int(page_cnt); page_i++ {
		if page_i == page {
			pagebar_str += fmt.Sprintf(`<li><span class="page-number current" id="%d">%d</span></li>`, page_i, page_i)
		} else {
			pagebar_str += fmt.Sprintf(`<li><a class="page-number" id="%d" href="javascript:void(0);">%d</a></li>`, page_i, page_i)
		}
	}
	next_page := page + 1
	if next_page <= int(page_cnt) {
		pagebar_str += fmt.Sprintf(`<li><a class="next page-number" id="%d" href="javascript:void(0);">Next <i class="icon-angle-right"></i></a></li>`, next_page)

	}

	sequence := (page - 1) * 6

	model_datas := getModelsName(sequence, 6)
	model_portfolio_str := ""
	for _, model_data := range model_datas {

		model_html := fmt.Sprintf(`<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mimg" >
                <div class="ih-item square effect8 ">
                    <a class="portfolio-item" href="javascript:void(0);">
                    <div class="img"><img src="/public/img/%s/index.jpg" alt="img"></div>
                    <div class="info">
                        <h3>%s</h3>

                        <p>FOREIGN MODELS</p>
                    </div>
                </a>
                </div>
            </div>`, model_data.Name, model_data.Name)
		model_portfolio_str += model_html
	}

	res_str := model_portfolio_str + "|" + pagebar_str
	return c.RenderJson(res_str)
}
