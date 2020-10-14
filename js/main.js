var application = new Vue({
    el:'#crudApp',
    data:{
        allData:'',
        myModel:false,
        actionButton:'Insert',
        dynamicTitle:'Add Data',
    },

    methods:{
        fetchAllData:function(){
            axios.post('db/action.php', {
            action:'fetchall'
            }).then(function(response){
            application.allData = response.data;
            });
        },

        openModel:function(){
            application.first_name = '';
            application.last_name = '';
            application.email = '';
            application.actionButton = "Insert";
            application.dynamicTitle = "Add Data";
            application.myModel = true;
        },

        submitData:function(){
            if(application.first_name != '' && application.last_name != '' && application.email != '' && application.phone != '') {
                if(application.actionButton == 'Insert')
                {
                    axios.post('db/action.php', {
                    action:'insert',
                    firstName:application.first_name, 
                    lastName:application.last_name,
                    email:application.email,
                    phone:application.phone
                    }).then(function(response){
                    application.myModel = false;
                    application.fetchAllData();
                    application.first_name = '';
                    application.last_name = '';
                    application.email = '';
                    application.phone = '';
                    alert(response.data.message);
                    });
                }

                if(application.actionButton == 'Update')
                {
                    axios.post('db/action.php', {
                    action:'update',
                    firstName : application.first_name,
                    lastName : application.last_name,
                    email : application.email,
                    phone : application.phone,
                    hiddenId : application.hiddenId
                    }).then(function(response){
                    application.myModel = false;
                    application.fetchAllData();
                    application.first_name = '';
                    application.last_name = '';
                    application.email = '';
                    application.phone = '';
                    application.hiddenId = '';
                    alert(response.data.message);
                    });
                }
            }
            else
            {
                alert("Fill All Field");
            }
        },

        fetchData:function(id){
            axios.post('db/action.php', {
                action:'fetchSingle',
                id:id
            }).then(function(response){
                application.first_name = response.data.first_name;
                application.last_name = response.data.last_name;
                application.email = response.data.email;
                application.phone = response.data.phone;
                application.hiddenId = response.data.id;
                application.myModel = true;
                application.actionButton = 'Update';
                application.dynamicTitle = 'Edit Data';
            });
        },

        deleteData:function(id){
            if(confirm("Are you sure you want to remove this data?")) {
                axios.post('db/action.php', {
                action:'delete',
                id:id
                }).then(function(response){
                    application.fetchAllData();
                    alert(response.data.message);
                });
            }
        }
    },

    created:function(){
        this.fetchAllData();
    }
});
