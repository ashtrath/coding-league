import { cn } from '@/lib/utils';
import { useForm } from '@inertiajs/react';
import { Form, FormField, FormSubmit } from '@radix-ui/react-form';
import { RiLoader5Line } from '@remixicon/react';
import { FormEventHandler } from 'react';
import Button from '../UI/Button';
import { Input, InputLabel, InputMessage } from '../UI/Input';
import Checkbox from '../UI/Input/Checkbox';
import { showToast } from '../UI/Toast';
import PasswordInput from './PasswordInput';

const LoginForm = ({ className }: { className?: string }) => {
    const { data, setData, post, processing, errors, reset } = useForm({
        email: '',
        password: '',
        remember: false,
    });

    const handleSubmit: FormEventHandler = (e) => {
        e.preventDefault();

        post(route('login'), {
            onFinish: () => reset('password'),
            onSuccess: () => showToast('Berhasil Login!', 'success'),
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
            <FormField name="password" className="space-y-2">
                <div className="flex items-baseline justify-between">
                    <InputLabel required>Kata Sandi</InputLabel>
                    <InputMessage match="valueMissing">
                        Kata Sandi tidak boleh kosong.
                    </InputMessage>
                    <InputMessage>{errors.password}</InputMessage>
                </div>
                <PasswordInput
                    placeholder="Masukan kata sandi Anda"
                    autoComplete="current-password"
                    required
                    value={data.password}
                    onChange={(e) => setData('password', e.target.value)}
                />
            </FormField>
            <FormField name="remember" className="flex items-center gap-2">
                <Checkbox id="remember_me" />
                <InputLabel htmlFor="remember_me">Ingat Saya</InputLabel>
            </FormField>
            <FormSubmit asChild>
                <Button
                    disabled={processing}
                    className="mt-2.5 w-[300px] place-self-end"
                >
                    {processing && (
                        <RiLoader5Line className="size-5 animate-spin" />
                    )}
                    Masuk
                </Button>
            </FormSubmit>
        </Form>
    );
};

export default LoginForm;
