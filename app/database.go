package app

import "fmt"

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

func GetModelCount() int {
	rows, err := G_DB.Query("SELECT COUNT(name) FROM model")
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

func GetModelNameBySequence(sequence int) string {
	rows, err := G_DB.Query(fmt.Sprintf("SELECT name FROM model WHERE sequence=%d", sequence))
	var model_name string
	for rows.Next() {
		err = rows.Scan(&model_name)
		if err != nil {
			fmt.Println(err.Error())
		}
	}
	return model_name
}

func GetModelInfoBySequence(sequence int) ModleData {
	rows, err := G_DB.Query(fmt.Sprintf("SELECT name,location,info FROM model WHERE sequence=%d", sequence))
	model_data := ModleData{}
	for rows.Next() {
		model_data := ModleData{}

		err = rows.Scan(&model_data.Name, &model_data.Location, &model_data.Info)
		if err != nil {
			fmt.Println(err.Error())
		}
		return model_data
	}
	return model_data
}

func GetModelsName(sequence, limit int) []ModleData {
	rows, err := G_DB.Query(fmt.Sprintf("SELECT name FROM model ORDER BY sequence limit %d,%d", sequence, limit))
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

func GetSequenceFromName(name string) int {
	rows, err := G_DB.Query(fmt.Sprintf("SELECT sequence FROM model WHERE name='%s'", name))
	if err != nil {
		fmt.Println(err.Error())
	}
	var sequence int
	for rows.Next() {
		err = rows.Scan(&sequence)
		if err != nil {
			fmt.Println(err.Error())
		}
	}
	return sequence
}

func GetModelsInfo(name string) ModleData {
	rows, err := G_DB.Query(fmt.Sprintf(`SELECT location,info FROM model WHERE name='%s'`, name))
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
