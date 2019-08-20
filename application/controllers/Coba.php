<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class coba extends CI_Controller
{
	public function index() {
		require 'application/vendor/autoload.php';

		$s3 = new Aws\S3\S3Client([
            'region'  => 'us-east-1',
            'version' => 'latest',
            'credentials' => [
                'key'    => "ASIA327OVDALBBBU5UQX",
                'secret' => "UnfLZSIGmMDvFGZEyoMx90vTOWC/sZdYUApDAuMx",
                'token' => "FQoGZXIvYXdzECMaDEaWh0ZoGsWmJjYmQiLrBJTUKc9YowkyvOgvU4W+Tp8Zlj2drASQO48oMYFD9JXG5HCZNhAGLcBm0fhkHcHqYXJvZzVMjQjAaLQlszjYbcLL4lFofJPra4ASVowUjpryzbRbwbtZ97X8v5ZGxDYYolqD67gawYt1ufYbmOKPHlMc/PQvxO65tWzNfIVrgw2g2SqKvDf2rGcku22RgCDhIO2FyAdpRWwXwd9VaMoAzUUQ0gPYayh5XKTMiSTs6xDnVfn9Ho1pIlgzudZ303by7Foj2yBTsM6MtpYTFpzdk/r6Dwq8Wa+lKv4o0wic4iqclpH61hHYWqaAIY6Y/ZJoQgDUuy6ABJg3B6Wr8NlHvaY9SHge/fE8UGL9tzzRLJUJc7zg5+9JHoSPfu5ZjIeFsH9/3WkYPrvqx/O1dsk8dmXcj5GiV75GI+NFO4cGTaX7sH80VwJNO7J39oFe7izh3Fs8XQEk92ORgNZDqBtPva/0fC4MXHCcEIAqs+r4YyDMgLqWXe6Q81rBSBdvuvq8DjHrjM2y54T05uRwLmqGHSaN37OKaafDuluSHElPgCz69p4e6pt6vqTBb6VjyMgyPvWQc30JAJ67ZBtE47RD+BOq3Kx8U+N8gvxzgKXYjibjL3rzawPvxHT4wBK5jFx31Bx1vi1Cidf6mTORyLsYgOSU7xUrz/IZwd/aLgD+Hw8SevK4fuv6ucBlgQLqgH/lXUuS/E3rSD8RVOTsUYYO4/OZt14zgGnqbxEmn2e/cCRAA31sJ9vyBZPGNZFSHulT2uTjwtTXpJJ5yWbsIvw4KB5tI04PMV76fdMTyXNLI3W3ZT85nqX2/OWLVYQoqujw6gU="
            ],
        ]);  

		 $result = $s3->putObject([
            'Bucket' => 'invendis',
            'ACL' => 'public-read',
            'Key'    => $file_name,
            'SourceFile' => $temp_file_location         
        ]);

		
	}


}