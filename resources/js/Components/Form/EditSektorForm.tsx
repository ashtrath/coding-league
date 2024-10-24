import { Sektor } from '@/Pages/Dashboard/Sektor';
import { FileUploadFileChangeDetails } from '@ark-ui/react';
import { useForm } from '@inertiajs/react';
import { Form, FormField, FormSubmit } from '@radix-ui/react-form';
import { RiLoader5Line, RiSendPlaneLine } from '@remixicon/react';
import { type FormEventHandler } from 'react';
import FileUploadBasic from '../FileUpload/FileUploadBasic';
import Button from '../UI/Button';
import { Card, CardContent } from '../UI/Card';
import { Input, InputLabel, InputMessage, Textarea } from '../UI/Input';
import { showToast } from '../UI/Toast';

interface EditSektorFormProps {
    initialData: Sektor;
}

const EditSektorForm = ({ initialData }: EditSektorFormProps) => {
    const { data, setData, post, processing, errors } = useForm({
        _method: 'put',
        name: initialData.name,
        description: initialData.description,
        image: null as File | null,
    });

    const handleFileChanges = ({
        acceptedFiles,
    }: FileUploadFileChangeDetails) => {
        if (acceptedFiles.length > 0) {
            setData('image', acceptedFiles[0]);
        }
    };

    const handleSubmit: FormEventHandler = (e) => {
        e.preventDefault();

        post(route('dashboard.sektor.update', initialData.id), {
            forceFormData: true,
            onSuccess: () =>
                showToast('Berhasil Mengubah Data Sektor!', 'success'),
            onError: (error) => {
                showToast(
                    'Terjadi kesalahan, silakan coba lagi.',
                    'destructive',
                );
                console.error(error);
            },
        });
    };

    return (
        <Form onSubmit={handleSubmit} className="space-y-6">
            <Card className="rounded-lg">
                <CardContent className="space-y-6 p-6">
                    <FormField name="image" className="space-y-2">
                        <div className="flex items-baseline justify-between">
                            <InputLabel>Foto Thumbnail</InputLabel>
                            <InputMessage>{errors.image}</InputMessage>
                        </div>
                        <FileUploadBasic
                            onFileChange={handleFileChanges}
                            maxFiles={1}
                            accept={{
                                'image/jpeg': ['.jpg', '.jpeg'],
                                'image/png': ['.png'],
                            }}
                            maxFileSize={1024 * 1024 * 10} // 10 MB
                        />
                    </FormField>
                    <FormField name="name" className="space-y-2">
                        <div className="flex items-baseline justify-between">
                            <InputLabel required>Nama Sektor</InputLabel>
                            <InputMessage match="valueMissing">
                                Nama sektor tidak boleh kosong.
                            </InputMessage>
                            <InputMessage>{errors.name}</InputMessage>
                        </div>
                        <Input
                            type="text"
                            placeholder="Nama Sektor"
                            required
                            value={data.name}
                            onChange={(e) => setData('name', e.target.value)}
                        />
                    </FormField>
                    <FormField name="description" className="space-y-2">
                        <div className="flex items-baseline justify-between">
                            <InputLabel>Deskripsi</InputLabel>
                            <InputMessage>{errors.description}</InputMessage>
                        </div>
                        <Textarea
                            placeholder="Masukan Deskripsi"
                            value={data.description}
                            onChange={(e) =>
                                setData('description', e.target.value)
                            }
                            className="min-h-[100px]"
                        />
                    </FormField>
                </CardContent>
            </Card>

            <Card>
                <CardContent className="flex items-center justify-end rounded-lg px-6 py-4">
                    <FormSubmit asChild>
                        <Button disabled={processing} className="gap-2">
                            {processing ? (
                                <RiLoader5Line className="size-5 animate-spin" />
                            ) : (
                                <RiSendPlaneLine className="size-5" />
                            )}
                            Submit
                        </Button>
                    </FormSubmit>
                </CardContent>
            </Card>
        </Form>
    );
};

export default EditSektorForm;
