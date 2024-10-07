import { cn } from '@/lib/utils';
import { useForm } from '@inertiajs/react';
import { Form, FormField, FormSubmit } from '@radix-ui/react-form';
import { FormEventHandler } from 'react';
import Button from '../UI/Button';
import { Input, InputLabel, InputMessage } from '../UI/Input';

const RegisterForm = ({ className }: { className?: string }) => {
    const { data, setData, post, processing, errors, reset } = useForm({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
    });

    const handleSubmit: FormEventHandler = (e) => {
        e.preventDefault();

        post(route('register'), {
            onFinish: () => reset('password', 'password_confirmation'),
        });
    };

    return (
        <Form onSubmit={handleSubmit} className={cn('grid gap-y-6', className)}>
            <FormField name="email" className="space-y-2">
                <div className="flex items-baseline justify-between">
                    <InputLabel required>Email</InputLabel>
                    <InputMessage match="typeMismatch">
                        Format email tidak valid.
                    </InputMessage>
                    <InputMessage match="valueMissing">
                        Email tidak boleh kosong.
                    </InputMessage>
                    <InputMessage>{errors.email}</InputMessage>
                </div>
                <Input
                    type="email"
                    placeholder="Masukan email Anda"
                    autoComplete="email"
                    required
                    value={data.email}
                    onChange={(e) => setData('email', e.target.value)}
                />
            </FormField>
            {/* TODO: change name to company_name when backend is ready */}
            <FormField name="name" className="space-y-2">
                <div className="flex items-baseline justify-between">
                    <InputLabel required>Nama Perusahaan</InputLabel>
                    <InputMessage match="valueMissing">
                        Nama Perusahaan tidak boleh kosong.
                    </InputMessage>
                    <InputMessage>{errors.name}</InputMessage>
                </div>
                <Input
                    type="text"
                    placeholder="Masukan nama perusahaan Anda"
                    autoComplete="name"
                    required
                    value={data.name}
                    onChange={(e) => setData('name', e.target.value)}
                />
            </FormField>
            <FormField name="password" className="space-y-2">
                <div className="flex items-baseline justify-between">
                    <InputLabel required>Kata Sandi</InputLabel>
                    <InputMessage match="valueMissing">
                        Kata Sandi tidak boleh kosong.
                    </InputMessage>
                    <InputMessage>{errors.password}</InputMessage>
                </div>
                <Input
                    type="password"
                    placeholder="Konfirmasi kata sandi"
                    autoComplete="new-password"
                    required
                    value={data.password}
                    onChange={(e) => setData('password', e.target.value)}
                />
            </FormField>
            <FormField name="password_confirmation" className="space-y-2">
                <div className="flex items-baseline justify-between">
                    <InputLabel required>Konfirmasi Kata Sandi</InputLabel>
                    <InputMessage match="valueMissing">
                        Kata Sandi tidak boleh kosong.
                    </InputMessage>
                    <InputMessage>{errors.password_confirmation}</InputMessage>
                </div>
                <Input
                    type="password"
                    placeholder="Konfirmasi kata sandi Anda"
                    autoComplete="new-password"
                    required
                    value={data.password_confirmation}
                    onChange={(e) =>
                        setData('password_confirmation', e.target.value)
                    }
                />
            </FormField>
            <FormSubmit asChild>
                <Button
                    variant="secondary"
                    disabled={processing}
                    className="mt-2.5 w-[300px]"
                >
                    Daftar
                </Button>
            </FormSubmit>
        </Form>
    );
};

export default RegisterForm;
