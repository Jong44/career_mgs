
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/860ae798ee.js" crossorigin="anonymous"></script>
    <link rel="icon" href="<?= base_url('assets')?>/img/lg-ico.ico">
    <link rel="stylesheet" href="<?= base_url('assets')?>/css/style.css">
    <title>Edit Job</title>
</head>
<body>
    <div class="content">
        <?php include 'partials/header.php'?>
        <p class="bold">Create A New Job</p>
        <form action="<?= base_url('user/prosesEditJob') ?>" method="post" enctype="multipart/form-data">
            <div class="create-job">
                <div class="img_upload">
                    <div class="bg-preview">
                        <img id="preview" src="<?= base_url('assets/img/job')?>/<?= $job['img_jobs'] ?>">
                    </div>
                    <input class="input-file" type="file" accept="image/*" onchange="previewImage(event)" name="filefoto" id="file_foto">
                    <div class="rows">
                        <p class="biru">Tips</p>
                        <p class="light">: For better view upload image more than (1560x520)px. Company cover image will be used if not uploaded.</p>
                    </div>
                    <input type="hidden" name="id_job" value="<?= $job['id_job'] ?>">
                    <div class="job-title">
                        <p class="light">Job Title*</p>
                        <input type="text" placeholder="Enter Your Job" name="nama_job" value="<?= $job['nama_job'] ?>" required>
                        <div class="rows">
                            <p class="biru">Tips</p>
                            <p class="light">: For better view upload image more than (1560x520)px. Company cover image will be used if not uploaded.</p>
                        </div>
                    </div>
                    <div class="job-detail">
                        <p class="light">Job Details*</p>
                        <textarea name="job_details" id="" cols="30" rows="10" placeholder="Enter Job Details" required>
                            <?= $job['job_details'] ?>
                        </textarea>
                    </div>
                    <div class="lainnya">
                        <div class="cols1">
                            <p class="light">Category*</p>
                            <select name="category"  id="selectCategory" required>
                                <option>Select Category</option>
                                <option value="<?= $job['category'] ?>" selected><?= $job['category']?></option>
                                <option value="IT(Information & Technology)">IT(Information & Technology)</option>
                                <option value="IT(Information & Technology)">IT(Information & Technology)</option>
                                <option value="IT(Information & Technology)">IT(Information & Technology)</option>
                                <option id="lainnya">Lainnya</option>
                            </select>
                            <p class="light">Country*</p>
                            <select name="country" id="select" required>
                                <option>Select Country</option>
                                <option value="<?= $job['country'] ?>" selected><?= $job['country']?></option>
                                <option value="Indonesia">Indonesia</option>
                                <option value="Jepang">Jepang</option>
                                <option value="Korea">Korea</option>
                            </select>
                            <p class="light">City*</p>
                            <select name="city" id="" required>
                                <option>Select City</option>
                                <option value="<?= $job['country'] ?>" selected><?= $job['country']?></option>
                                <option value="Wonosobo">Wonosobo</option>
                                <option value="Jakarta">Jakarta</option>
                                <option value="Yogyakarta">Yogyakarta</option>
                            </select>
                        </div>
                        <div class="cols2">
                            <p class="light">Vacancies*</p>
                            <input type="number" name="vacancies" placeholder="Enter Vacancies" value="<?= $job['vacancies'] ?>" required>
                            <p class="light">State*</p>
                            <select name="state" id="" required>
                                <option>Select State</option>
                                <option value="Indonesia">Indonesia</option>
                                <option value="Jepang">Jepang</option>
                                <option value="Korea">Korea</option>
                            </select>
                            <p class="light">Expiry Date*</p>
                            <input type="date" name="exp_date" placeholder="Enter Date" value="<?= $job['exp_date'] ?>" required>
                        </div>
                    </div>
                    <div class="skill">
                        <p class="light">Add Skils*</p>
                        <select name="skill" id="" required>
                            <option>Select Skill</option>
                            <option value="Indonesia">SQL</option>
                            <option value="Jepang">Rest APi</option>
                            <option value="Korea">DevOps</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="create-job2">
                <div class="cols1">
                    <p class="light">Employment Type*</p>
                    <select name="employment_type" required>
                        <option>Select Employment Type</option>
                        <option value="Month">Full Time</option>
                        <option value="Years">Half Time</option>
                    </select>

                    <p class="light">Salary Type*</p>
                    <select name="salary_type" id="">
                        <option>Select Salary Type</option>
                        <option value="Month">Month</option>
                        <option value="Years">Years</option>
                        <option value="Project">Project</option>
                    </select>

                    <p class="light">Office Time*</p>
                    <input type="text" name="office_time" placeholder="Enter Office Time" value="<?= $job['office_time'] ?>" required>
                    <div class="rows">
                        <p class="biru">Hint</p>
                        <p class="light">: Type your office time like [SUN-TUE : 8:00 AM to 6:00 PM]</p>
                    </div>
                </div>
                <div class="cols2">
                    <p class="light">Experience Level*</p>
                    <select name="experience" id="" required>
                        <option>Select Experience Level</option>
                        <option value="Intermadiate">Intermadiate Level</option>
                        <option value="Entry">Entry Level</option>
                        <option value="Mid">Mid Level</option>
                    </select>
                    <p class="light">Salary*</p>
                    <input type="number" name="salary" id="" placeholder="Enter Salary" value="<?= $job['salary'] ?>" required>
                </div>
            </div>
            <div class="btnnn">
                <button type="submit">Submit</button>
                <button class="reset" type="reset">Reset</button>
            </div>
        </form>
        <br>
        <?php
            if($this->session->flashdata('pesan') <> ''){
        ?>
            <div class="alert alert-dismissible alert-danger">
                <?php echo $this->session->flashdata('pesan');?>
            </div>
                <?php
            }
        ?>
        <br><br><br><br><br>
    </div>
    <script>
        const previewImage = e => {
            const reader = new FileReader();
            reader.readAsDataURL(e.target.files[0]);
            reader.onload = () => {
                const preview = document.getElementById('preview');
                preview.src = reader.result;
            };
        };   
    </script>
</body>
</html>