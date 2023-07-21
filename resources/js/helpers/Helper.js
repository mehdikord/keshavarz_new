
class Helper {

    HelperStorageSet(key,item){
        localStorage.setItem(key,item);
    }
    HelperStorageGet(key){
        localStorage.getItem(key);
    }
    HelperStorageRemove(key){
        localStorage.removeItem(key);
    }
    HelperNumberToEn(number) {
        if (number !== null){
            let find = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
            let replace = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
            let replaceString = number;
            let regex;
            for (let i = 0; i < find.length; i++) {
                regex = new RegExp(find[i], "g");
                replaceString = replaceString.replace(regex, replace[i]);
            }
            return replaceString;
        }
        return number;
    }
    HelperValidationErrors(errors={},field){
        return errors[field] && errors[field].length ? errors[field] : {};
    }
    HelperValidationCheck(errors={},field){
        return !!(errors[field] && errors[field].length);
    }
}

export default Helper = new Helper()
