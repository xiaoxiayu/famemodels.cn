// GENERATED CODE - DO NOT EDIT
package routes

import "github.com/revel/revel"


type tApp struct {}
var App tApp


func (_ tApp) Index(
		) string {
	args := make(map[string]string)
	
	return revel.MainRouter.Reverse("App.Index", args).Url
}

func (_ tApp) ModelGallery(
		name string,
		) string {
	args := make(map[string]string)
	
	revel.Unbind(args, "name", name)
	return revel.MainRouter.Reverse("App.ModelGallery", args).Url
}

func (_ tApp) CreateModelInfoHtml(
		name string,
		) string {
	args := make(map[string]string)
	
	revel.Unbind(args, "name", name)
	return revel.MainRouter.Reverse("App.CreateModelInfoHtml", args).Url
}

func (_ tApp) LoadPortfolioContent(
		name string,
		) string {
	args := make(map[string]string)
	
	revel.Unbind(args, "name", name)
	return revel.MainRouter.Reverse("App.LoadPortfolioContent", args).Url
}

func (_ tApp) ModelPortfolio(
		page int,
		state int,
		) string {
	args := make(map[string]string)
	
	revel.Unbind(args, "page", page)
	revel.Unbind(args, "state", state)
	return revel.MainRouter.Reverse("App.ModelPortfolio", args).Url
}


type tStatic struct {}
var Static tStatic


func (_ tStatic) Serve(
		prefix string,
		filepath string,
		) string {
	args := make(map[string]string)
	
	revel.Unbind(args, "prefix", prefix)
	revel.Unbind(args, "filepath", filepath)
	return revel.MainRouter.Reverse("Static.Serve", args).Url
}

func (_ tStatic) ServeModule(
		moduleName string,
		prefix string,
		filepath string,
		) string {
	args := make(map[string]string)
	
	revel.Unbind(args, "moduleName", moduleName)
	revel.Unbind(args, "prefix", prefix)
	revel.Unbind(args, "filepath", filepath)
	return revel.MainRouter.Reverse("Static.ServeModule", args).Url
}


type tTestRunner struct {}
var TestRunner tTestRunner


func (_ tTestRunner) Index(
		) string {
	args := make(map[string]string)
	
	return revel.MainRouter.Reverse("TestRunner.Index", args).Url
}

func (_ tTestRunner) Run(
		suite string,
		test string,
		) string {
	args := make(map[string]string)
	
	revel.Unbind(args, "suite", suite)
	revel.Unbind(args, "test", test)
	return revel.MainRouter.Reverse("TestRunner.Run", args).Url
}

func (_ tTestRunner) List(
		) string {
	args := make(map[string]string)
	
	return revel.MainRouter.Reverse("TestRunner.List", args).Url
}


