<template>
  <v-data-table
    :headers="headers"
    :items="disease"
    sort-by="calories"
    class="elevation-1"
    :search="search"
  >
    <template v-slot:top>
      <v-toolbar
        flat
      >
        <v-toolbar-title>Medicine Records</v-toolbar-title>
        <v-divider
          class="mx-4"
          inset
          vertical
        ></v-divider>
        <v-text-field
        append-icon="mdi-magnify"
        v-model="search"
        flat
        ></v-text-field>
        <v-spacer></v-spacer>
        <v-dialog
          v-model="dialog"
          width="1000px"
        >
          <template v-slot:activator="{ on, attrs }">
            <v-btn
              color="primary"
              dark
              class="mb-2"
              v-bind="attrs"
              v-on="on"
            >
              New Disease Information
            </v-btn>
          </template>
          <v-card>
            <v-card-title>
              <span class="text-h5">{{ formTitle }}</span>
            </v-card-title>

            <v-card-text>
              <v-container>
                <v-row>
                   <v-col
                   cols="12"
                    sm="6"
                    md="12">
                    <label>Disease Information</label>
                  </v-col>
                  <v-col
                    cols="12"
                    sm="6"
                    md="4"
                  >
                    <v-text-field
                      v-model="editedItem.name"
                      label="Name"
                    ></v-text-field>
                  </v-col>
                  <v-col
                    cols="12"
                    sm="6"
                    md="4"
                  >
                    <v-text-field
                      v-model="editedItem.description"
                      label="Description"
                    ></v-text-field>
                  </v-col>
                  <v-col
                    cols="12"
                    sm="6"
                    md="4"
                  >
                    <v-text-field
                      v-model="editedItem.symptoms"
                      label="Symptoms"
                    ></v-text-field>
                  </v-col>
                </v-row>
              </v-container>
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn
                color="blue darken-1"
                text
                @click="close"
              >
                Cancel
              </v-btn>
              <v-btn
                color="blue darken-1"
                text
                @click="save"
              >
                Save
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
        <v-dialog v-model="dialogDelete" max-width="500px">
          <v-card>
            <v-card-title class="text-h5">Are you sure you want to delete this item?</v-card-title>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="closeDelete">Cancel</v-btn>
              <v-btn color="blue darken-1" text @click="deleteItemConfirm">OK</v-btn>
              <v-spacer></v-spacer>
            </v-card-actions>
          </v-card>
        </v-dialog>
        <v-dialog
        v-model="subjDialog"
        max-width="700px"
        >
        <v-card>
          <v-card-title>
          Add Enrolled Subject

          </v-card-title>
          <v-text-field v-model="editedItem.id" style="display:none"></v-text-field>

          <v-container>
            <div v-for="(payloads, index) in payload" :key="index">
            
                <label>Course {{(index + 1)}}</label>

                        <v-text-field v-model="payloads.course_code" :label="'Course Code'"></v-text-field>
                        <v-text-field v-model="payloads.course" :label="'Course'"></v-text-field>
                        <v-text-field type="number" v-model="payloads.unit" :label="'Unit'"></v-text-field>
                        <v-text-field v-model="payloads.school_year" :label="'School Year'"></v-text-field>
                        <v-btn @click="removeField(index)" class="mb-2">
                        <v-icon>mdi-minus</v-icon>
                        </v-btn>
                </div>
              <v-btn text elevation="0" @click="addField()" :disabled="payload.length >= 10"> 
                <v-icon dark>
                  mdi-plus
                </v-icon>
              </v-btn>
              <v-btn color="primary" @click="submitSubject()" :disabled="payload.length == 0">Submit</v-btn>
          </v-container>
        </v-card>
        </v-dialog>
      </v-toolbar>
    </template>
    <template v-slot:item.actions="{ item }">
      <!-- <v-icon
        small
        class="mr-2"
        @click="enrollSubj(item)"
      >
      mdi-notebook
      </v-icon> -->
      <v-icon
        small
        class="mr-2"
        @click="editItem(item)"
      >
        mdi-pencil
      </v-icon>
      <v-icon
        small
        @click="deleteItem(item)"
      >
        mdi-delete
      </v-icon>
    </template>
    <template v-slot:no-data>
      <v-btn
        color="primary"
        @click="display()"
      >
        Reset
      </v-btn>
    </template>
  </v-data-table>
</template>
<script>
import axios from '../../plugins/axios'
  export default {
    data: () => ({
    
      dialog: false,
      dialogDelete: false,
      subjDialog: false,
      headers: [
        { text: 'Name', value: 'name' },
        { text: 'Description', value: 'description' },
        { text: 'Symptoms', value: 'symptoms' },
        { text: 'Actions', value: 'actions', sortable: false },
      ],
      search: '',
      disease: [],
      editedIndex: -1,
      editedItem: {
        dname: '',
       description: '',
       symptoms: ''
       
      },
      defaultItem: {
       dname: '',
       description: '',
       symptoms: ''

      },
      selectedItemId: null,
      payload: []
    }),

    computed: {
      formTitle () {
        return this.editedIndex === -1 ? 'New Disease' : 'Edit Disease'
      },
    },

    watch: {
      dialog (val) {
        val || this.close()
      },
      subjDialog (val) {
        val || this.close()
      },
      dialogDelete (val) {
        val || this.closeDelete()
      },
    },

    // created () {
    //   this.initialize()
    //   this.display
    // },
    mounted (){
      this.display()
    },

    methods: {
      

      editItem (item) {
        this.editedIndex = this.disease.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialog = true
      },

      deleteItem (item) {
        this.editedIndex = this.disease.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialogDelete = true
      },

      deleteItemConfirm () {
        this.disease.splice(this.editedIndex, 1)
        this.closeDelete()
      },

      close () {
        this.dialog = false
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        })
        this.payload = []
      },

      closeDelete () {
        this.dialogDelete = false
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        })
      },

      save () {

        if (this.editedIndex > -1) {
            axios.post('update-disease/' + this.editedItem.id, this.editedItem).then(res => {
            console.log(res)
            window.alert('Disease information Updated');
            this.dialog = false
            this.display()
        })
        } else {
            axios.post('add-disease', this.editedItem).then(res => {
            console.log(res)
            window.alert('Disease Information Added');
            this.dialog = false
            this.display()
        })
        }
      
      },
      display() {
        axios.get('get-disease').then(res => {
          console.log(res)
          this.disease = res.data
        })
      },
      enrollSubj(item){
         this.editedIndex = this.students.indexOf(item)
        this.editedItem = Object.assign({}, item)
        // this.load = item
        this.subjDialog = true
        console.log(this.editedItem.id)
      },
      addField() {
        this.payload.push({
        course_code: '',
        course: '',
        unit: '',
        school_year: '',
      })
      },
       removeField(index) {
      this.payload.splice(index, 1)
      },
      submitSubject() {
        const payloads = this.payload.map((item) => {
          return {
            student_id: this.editedItem.id,
            course_code: item.course_code,
            course: item.course,
            unit: item.unit,
            school_year: item.school_year
          };
        });

        console.log(payloads);

        axios.post('insert-subjects', payloads).then (res => {
          console.log(res.data, ' Response ')
        })
      
      },

      
    },
  }
</script>